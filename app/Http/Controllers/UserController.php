<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\BankUser;
use App\Models\MarketPrice;
use App\Models\Setting;
use App\Models\TransferBalanceLog;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function login()
    {
        return view('user.auth.login');
    }

    public function do_login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function register(Request $request)
    {
        $referral = $request->referral;
        return view('user.auth.register', compact('referral'));
    }

    public function do_register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'max:50'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $bytes = random_bytes(5);
        $account_id = bin2hex($bytes);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'account_id' => $account_id,
            'password' => bcrypt($request->password),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('User');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function market_rates()
    {
        $market_prices = MarketPrice::whereIsActive(1)->get();
        return view('user.market_rates', compact('market_prices'));
    }

    public function fund_wallet()
    {
        // $market_prices = MarketPrice::whereIsActive(1)->get();
        return view('user.fund_wallet'/* , compact('market_prices') */);
    }

    public function transfer_balance()
    {
        return view('user.transfer_balance');
    }

    public function do_transfer_balance(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:10',
            'account_id' => 'required',
            'pin' => 'required',
            'currency' => 'required|in:usd,gbp'
        ]);
        $user = auth()->user();
        if (!$user->pin) {
            return back()->with('error', 'Please setup your Pin!');
        }
        if ($user->pin != $request->pin) {
            return back()->with('error', 'You have entered wrong Pin!');
        }
        $customer = User::where('account_id', $request->account_id)->first();
        if (!$user->hasRole('Vendor')) {
            return back()->with('error', 'You do not have authority to transfer!');
        }
        if (!$user->is_verified) {
            return back()->with('error', 'Your account is not verified!');
        }
        if (!$customer) {
            return back()->with('error', 'Invalid ACCOUNT ID!');
        }
        if ($user->account_id == $request->account_id) {
            return back()->with('error', 'You cannot transfer balance to yourself!');
        }

        if ($request->currency == 'usd') {
            if ($request->amount < 10) {
                return back()->with('error', 'Minimum amount to transfer is $10');
            }
            if ($request->amount > $user->usd_wallet) {
                return back()->with('error', 'Your entered amount is more than your USD balance');
            }
            $logdata['ref_id'] = Str::random(10);
            $logdata['vendor_account_id'] = $user->account_id;
            $logdata['currency'] = $request->currency;
            $logdata['amount'] = $request->amount;
            $logdata['user_account_id'] = $request->account_id;
            $user_usd_wallet = $user->usd_wallet - $request->amount;
            $customer_usd_wallet = $customer->usd_wallet + $request->amount;
            DB::transaction(function () use ($user_usd_wallet, $customer_usd_wallet, $logdata, $user, $customer) {
                $user->update(['usd_wallet' => $user_usd_wallet]);
                $customer->update(['usd_wallet' => $customer_usd_wallet]);
                TransferBalanceLog::create($logdata);
            });
            $amount = '$ ' . $request->amount;
        } else {
            if ($request->amount < 10) {
                return back()->with('error', 'Minimum amount to transfer is £10');
            }
            if ($request->amount > $user->gbp_wallet) {
                return back()->with('error', 'Your entered amount is more than your GBP balance');
            }
            $logdata['ref_id'] = Str::random(10);
            $logdata['vendor_account_id'] = $user->account_id;
            $logdata['currency'] = $request->currency;
            $logdata['amount'] = $request->amount;
            $logdata['user_account_id'] = $request->account_id;
            $user_gbp_wallet = $user->gbp_wallet - $request->amount;
            $customer_gbp_wallet = $customer->gbp_wallet + $request->amount;
            DB::transaction(function () use ($user_gbp_wallet, $customer_gbp_wallet, $logdata, $user, $customer) {
                $user->update(['gbp_wallet' => $user_gbp_wallet]);
                $customer->update(['gbp_wallet' => $customer_gbp_wallet]);
                TransferBalanceLog::create($logdata);
            });
            $amount = '£ ' . $request->amount;
        }
        return redirect()->route('user.transfer_balance')->with('success', 'Amount ' . $amount . ' Transfered to Account ID: ' . $customer->account_id . ' - ' . $customer->name);
    }

    public function withdraw()
    {
        $user_bank_details = BankUser::with('bank')->where('user_id', auth()->user()->id)->first();
        return view('user.withdraw', compact('user_bank_details'));
    }

    public function do_withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:10',
            'bank_user_id' => 'required',
            'pin' => 'required'
        ]);
        $bank_user = BankUser::find($request->bank_user_id);
        $user = auth()->user();
        $setting = Setting::first();
        if (!$user->pin) {
            return back()->with('error', 'Please setup your Pin!');
        }
        if ($user->pin != $request->pin) {
            return back()->with('error', 'You have entered wrong Pin!');
        }
        if (!$user->is_verified) {
            return back()->with('error', 'Your account is not verified!');
        }
        $actual_amount = $request->amount;
        $bank_user_id = $request->bank_user_id;
        $after_fee_amount = $actual_amount - ($actual_amount * $setting->withdraw_fee / 100);
        // return $after_fee_amount;
        if ($actual_amount < 10) {
            return back()->with('error', 'Minimum amount to withdraw is $10');
        }
        if ($actual_amount > $user->ngn_wallet) {
            return back()->with('error', 'Your entered amount is more than your NGN balance');
        }
        DB::transaction(function () use ($user, $actual_amount, $after_fee_amount, $bank_user_id) {
            $user->update(['ngn_wallet' => $user->ngn_wallet - $actual_amount]);
            Withdraw::create([
                'user_id' => $user->id,
                'bank_user_id' => $bank_user_id,
                'amount' => $after_fee_amount,
                'status' => 0
            ]);
        });
        return redirect()->route('user.withdraw')->with('success', 'Amount ₦' . number_format($actual_amount, 2) . ' Withdrawed to your Bank Account: ' . $bank_user->get_full_account);
    }

    public function verify_trader()
    {
        return view('user.verify_trader');
    }

    public function do_verify_trader(Request $request)
    {
        $trader = User::where('account_id', $request->account_id)->first();
        $verification_result = true;
        if ($trader->hasRole('Vendor')) {
            $is_verified = true;
        } else {
            $is_verified = false;
        }
        return view('user.verify_trader', compact('verification_result', 'is_verified', 'trader'));
    }

    public function change_pin()
    {
        return view('user.change_pin');
    }

    public function do_change_pin(Request $request)
    {
        $request->validate([
            'old_pin' => ['required', 'string'],
            'new_pin' => ['required', 'confirmed'],
        ]);
        try {
            $user = $request->user();
            $old_pin = $user->pin;
            if ($old_pin && $old_pin != $request->old_pin) {
                return back()->with('error', 'You have entered wrong old pin!');
            }
            $user->update([
                'pin' => $request->new_pin
            ]);
            return back()->with('success', 'Pin changed');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/app/login');
    }
}
