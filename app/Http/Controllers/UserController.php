<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\MarketPrice;
use App\Models\TransferBalanceLog;
use App\Models\User;
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
        $user = auth()->user();
        if (!$user->hasRole('Vendor')) {
            return back()->with('error', 'You do not have authority to transfer!');
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
            $vendor = User::where('account_id', $user->account_id)->get();
            $vendor_usd_wallet = $vendor->usd_wallet - $request->amount;
            $user = User::where('account_id', $request->account_id)->get();
            $user_usd_wallet = $user->usd_wallet + $request->amount;
            DB::transaction(function () use ($vendor_usd_wallet, $user_usd_wallet, $logdata, $vendor, $user) {
                $vendor->update(['usd_wallet' => $vendor_usd_wallet]);
                $user->update(['usd_wallet' => $user_usd_wallet]);
                TransferBalanceLog::create($logdata);
            });
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
            $vendor = User::where('account_id', $user->account_id)->get();
            $vendor_gbp_wallet = $vendor->gbp_wallet - $request->amount;
            $user = User::where('account_id', $request->account_id)->get();
            $user_gbp_wallet = $user->gbp_wallet + $request->amount;
            DB::transaction(function () use ($vendor_gbp_wallet, $user_gbp_wallet, $logdata, $vendor, $user) {
                $vendor->update(['gbp_wallet' => $vendor_gbp_wallet]);
                $user->update(['gbp_wallet' => $user_gbp_wallet]);
                TransferBalanceLog::create($logdata);
            });
        }
        return redirect()->route('user.transfer_balance')->with('success', 'Amount Transfered to Account ID: ' . $request->account_id);
    }

    public function verify_trader($verification_result = null, $is_verified = null, $vendor = null)
    {
        return view('user.verify_trader', compact('verification_result', 'is_verified', 'vendor'));
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

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/app/login');
    }
}
