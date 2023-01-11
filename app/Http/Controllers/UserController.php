<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Mail\GeneralEmail;
use App\Models\BankUser;
use App\Models\BlackmarketLog;
use App\Models\ContentPage;
use App\Models\MarketPrice;
use App\Models\ReferralLog;
use App\Models\ReferralWithdrawLog;
use App\Models\Setting;
use App\Models\TransferBalanceLog;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Throwable;

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
        $parent_id = null;
        if ($request->has('referral')) {
            $request->validate([
                'referral' => ['required', 'string']
            ]);
            $referral_user = User::where('username', $request->referral)->first();
            $parent_id = $referral_user->id;
        }

        $bytes = random_bytes(5);
        $account_id = bin2hex($bytes);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'account_id' => $account_id,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(10),
            'parent_id' => $parent_id,
        ]);

        $user->assignRole('User');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function dashboard()
    {
        $user_account_id = auth()->user()->account_id;
        $user_id = auth()->user()->id;
        $transfer_logs = TransferBalanceLog::with('vendor', 'user')->where('vendor_account_id', $user_account_id)->orWhere('user_account_id', $user_account_id)->latest()->take(5)->get();
        $blackmarket_logs = BlackmarketLog::where('user_id', $user_id)->where('status', 1)->latest()->take(5)->get();
        $withdraws = Withdraw::where('user_id', $user_id)->latest()->take(5)->get();
        return view('user.dashboard', compact('transfer_logs', 'user_account_id', 'blackmarket_logs', 'withdraws'));
    }

    public function market_rates()
    {
        $market_prices = MarketPrice::whereIsActive(1)->get();
        return view('user.market_rates', compact('market_prices'));
    }

    public function fund_wallet()
    {
        return view('user.fund_wallet');
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
        $customer = User::with('parent')->where('account_id', $request->account_id)->first();
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
        $setting = Setting::first();
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
            $logdata['user_account_id'] = strtolower($request->account_id);
            $user_usd_wallet = $user->usd_wallet - $request->amount;
            $customer_usd_wallet = $customer->usd_wallet + $request->amount;
            $market_price = MarketPrice::whereSymbol('$')->pluck('local_rate');
            $amount = ($logdata['amount'] * $setting->usd_referral_bonus / 100) * $market_price[0];
            DB::transaction(function () use ($user_usd_wallet, $customer_usd_wallet, $logdata, $user, $customer, $amount) {
                $user->update(['usd_wallet' => $user_usd_wallet]);
                $customer->update(['usd_wallet' => $customer_usd_wallet]);
                if (!empty($customer->parent)) {
                    $referral_log = ReferralLog::where('upline_id', $customer->parent->id)->where('downline_id', $customer->id)->first();
                    if (empty($referral_log)) {
                        ReferralLog::create([
                            'upline_id' => $customer->parent->id, 'downline_id' => $customer->id, 'currency' => '₦', 'amount' => $amount, 'type' => 1
                        ]);
                        $customer->parent->update(['ref_ngn_wallet' => $customer->parent->ref_ngn_wallet + $amount]);
                    }
                }
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
            $logdata['user_account_id'] = strtolower($request->account_id);
            $user_gbp_wallet = $user->gbp_wallet - $request->amount;
            $customer_gbp_wallet = $customer->gbp_wallet + $request->amount;
            $market_price = MarketPrice::whereSymbol('£')->pluck('local_rate');
            $amount = ($logdata['amount'] * $setting->gbp_referral_bonus / 100) * $market_price[0];
            DB::transaction(function () use ($user_gbp_wallet, $customer_gbp_wallet, $logdata, $user, $customer, $amount) {
                $user->update(['gbp_wallet' => $user_gbp_wallet]);
                $customer->update(['gbp_wallet' => $customer_gbp_wallet]);
                if (!empty($customer->parent)) {
                    $referral_log = ReferralLog::where('upline_id', $customer->parent->id)->where('downline_id', $customer->id)->first();
                    if (empty($referral_log)) {
                        ReferralLog::create([
                            'upline_id' => $customer->parent->id, 'downline_id' => $customer->id, 'currency' => '₦', 'amount' => $amount, 'type' => 1
                        ]);
                        $customer->parent->update(['ref_ngn_wallet' => $customer->parent->ref_ngn_wallet + $amount]);
                    }
                }
                TransferBalanceLog::create($logdata);
            });
            $amount = '£ ' . $request->amount;
        }
        return redirect()->route('user.transfer_balance')->with('success', 'Amount ' . $amount . ' Transfered to Account ID: ' . $customer->account_id . ' - ' . $customer->name);
    }

    public function withdraw()
    {
        $user_bank_details = BankUser::with('bank')->where('user_id', auth()->user()->id)->first();
        $withdraws = Withdraw::where('user_id', auth()->user()->id)->get();
        // return $withdraws;
        return view('user.withdraw', compact('user_bank_details', 'withdraws'));
    }

    public function do_withdraw(Request $request)
    {
        $today = Carbon::now();
        $day_of_week = $today->format('l');
        if ($day_of_week != 'Sunday') {
            return back()->with('warning', 'You can request to withdraw every Sunday to your BANK Account only.');
        }
        if ($today->hour < 7 || $today->hour > 10) {
            return back()->with('warning', 'You can cashout your Video Earning Points from 7am to 10am.');
        }
        $request->validate([
            'amount' => 'required|integer|min:10',
            'bank_user_id' => 'required',
            'pin' => 'required'
        ]);
        $bank_user = BankUser::find($request->bank_user_id);
        $user = auth()->user();
        $setting = Setting::first();
        if (!$user->is_verified) {
            return back()->with('error', 'Your account is not verified!');
        }
        if (!$user->pin) {
            return back()->with('error', 'Please setup your Pin!');
        }
        if ($user->pin != $request->pin) {
            return back()->with('error', 'You have entered wrong Pin!');
        }
        $actual_amount = $request->amount;
        $bank_user_id = $request->bank_user_id;
        $after_fee_amount = $actual_amount - ($actual_amount * $setting->withdraw_fee / 100);
        // return $after_fee_amount;
        if ($actual_amount < $setting->min_withdrawal) {
            return back()->with('error', 'Minimum amount to withdraw is ₦' . $setting->min_withdrawal);
        }
        if ($actual_amount > $user->ngn_wallet) {
            return back()->with('error', 'Your entered amount is more than your NGN balance');
        }
        if ($actual_amount > $setting->max_withdrawal) {
            return back()->with('error', 'Maximum amount to withdraw is ₦' . $setting->max_withdrawal);
        }
        DB::transaction(function () use ($user, $actual_amount, $after_fee_amount, $bank_user_id) {
            $user->update(['ngn_wallet' => $user->ngn_wallet - $actual_amount]);
            $data = Withdraw::create([
                'user_id' => $user->id,
                'bank_user_id' => $bank_user_id,
                'amount' => $after_fee_amount,
                'status' => 0
            ]);
            Mail::to($user->email)->send(new GeneralEmail($user->name, 'Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' is pending<br>Thanks for working with us.', 'Withdraw Request is pending'));
        });
        return redirect()->route('user.withdraw')->with('success', 'Amount ₦' . number_format($actual_amount, 2) . ' Withdrawed to your Bank Account: ' . $bank_user->get_full_account);
    }

    public function withdraw_referral()
    {
        $user_bank_details = BankUser::with('bank')->where('user_id', auth()->user()->id)->first();
        $withdraws = ReferralWithdrawLog::where('user_id', auth()->user()->id)->get();
        // return $withdraws;
        return view('user.withdraw_referral', compact('user_bank_details', 'withdraws'));
    }

    public function do_withdraw_referral(Request $request)
    {
        // $today = Carbon::now();
        // $day_of_week = $today->format('l');
        // if ($day_of_week != 'Sunday') {
        //     return back()->with('warning', 'You can request to withdraw every Sunday to your BANK Account only.');
        // }
        // if ($today->hour < 7 || $today->hour > 10) {
        //     return back()->with('warning', 'You can cashout your Video Earning Points from 7am to 10am.');
        // }
        $request->validate([
            'amount' => 'required|integer|min:10',
            'bank_user_id' => 'required',
            'pin' => 'required'
        ]);
        $bank_user = BankUser::find($request->bank_user_id);
        $user = auth()->user();
        $setting = Setting::first();
        if (!$user->is_verified) {
            return back()->with('error', 'Your account is not verified!');
        }
        if (!$user->pin) {
            return back()->with('error', 'Please setup your Pin!');
        }
        if ($user->pin != $request->pin) {
            return back()->with('error', 'You have entered wrong Pin!');
        }
        $actual_amount = $request->amount;
        $bank_user_id = $request->bank_user_id;
        $after_fee_amount = $actual_amount - ($actual_amount * $setting->referral_withdraw_fee / 100);
        // return $after_fee_amount;
        if ($actual_amount < $setting->min_withdrawal_referral) {
            return back()->with('error', 'Minimum amount to withdraw is ₦' . $setting->min_withdrawal_referral);
        }
        if ($actual_amount > $user->ref_ngn_wallet) {
            return back()->with('error', 'Your entered amount is more than your NGN balance');
        }
        if ($actual_amount > $setting->max_withdrawal_referral) {
            return back()->with('error', 'Maximum amount to withdraw is ₦' . $setting->max_withdrawal_referral);
        }
        DB::transaction(function () use ($user, $actual_amount, $after_fee_amount, $bank_user_id) {
            $user->update(['ref_ngn_wallet' => $user->ref_ngn_wallet - $actual_amount]);
            $data = ReferralWithdrawLog::create([
                'user_id' => $user->id,
                'bank_user_id' => $bank_user_id,
                'amount' => $after_fee_amount,
                'status' => 0
            ]);
            Mail::to($user->email)->send(new GeneralEmail($user->name, 'Referral Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' is pending<br>Thanks for working with us.', 'Withdraw Request is pending', 1));
        });
        return redirect()->route('user.withdraw_referral')->with('success', 'Amount ₦' . number_format($actual_amount, 2) . ' Withdrawed to your Bank Account: ' . $bank_user->get_full_account);
    }

    public function sell_to_blackmarket()
    {
        $blackMarketLogObj = BlackmarketLog::where('user_id', auth()->user()->id);
        $logs = $blackMarketLogObj->get();
        $latest_log = $blackMarketLogObj->where('status', 0)->latest('id')->first();
        return view('user.sell_to_blackmarket', compact('logs', 'latest_log'));
    }

    public function do_sell_to_blackmarket(Request $request)
    {
        // return $request;
        $today = Carbon::now();
        $day_of_week = $today->format('l');
        // $days_not_allowed = ['Saturday', 'Sunday'];
        // if(in_array($day_of_week, $days_not_allowed)) {
        //     return back()->with('warning', 'You cannot use black market on Saturday and Sunday.');
        // }
        $request->validate([
            'amount_sold' => 'required|integer|min:10|max:35000',
            'amount_exchanged' => 'required|integer',
            'currency' => 'required',
            'pin' => 'required',
        ]);
        $user = auth()->user();
        if (!$user->is_verified) {
            return back()->with('error', 'Your account is not verified!');
        }
        if (!$user->pin) {
            return back()->with('error', 'Please setup your Pin!');
        }
        if ($user->pin != $request->pin) {
            return back()->with('error', 'You have entered wrong Pin!');
        }
        $setting = Setting::first();
        $currency = $request->currency;
        $amount_sold = $request->amount_sold;
        $ref_id = Str::random(10);
        // return $after_fee_amount;
        if ($currency == 'usd') {
            if ($amount_sold > $user->usd_wallet) {
                return back()->with('error', 'Your entered amount is more than your NGN balance');
            } else {
                $user_data = [
                    'usd_wallet' => $user->usd_wallet - $amount_sold
                ];
                $black_market_data = [
                    'ref_id' => $ref_id,
                    'user_id' => $user->id,
                    'amount_sold' => $amount_sold,
                    'amount_exchanged' => $request->amount_exchanged,
                    'currency' => $currency,
                    'status' => 0,
                    // 'completed_at' => Carbon::now()->addSeconds($setting->usd_black_market_counter)
                    'completed_at' => Carbon::now()->addHours($setting->usd_black_market_counter)
                ];
            }
        }
        if ($currency == 'gbp') {
            if ($amount_sold > $user->gbp_wallet) {
                return back()->with('error', 'Your entered amount is more than your NGN balance');
            } else {
                $user_data = [
                    'gbp_wallet' => $user->gbp_wallet - $amount_sold
                ];
                $black_market_data = [
                    'ref_id' => $ref_id,
                    'user_id' => $user->id,
                    'amount_sold' => $amount_sold,
                    'amount_exchanged' => $request->amount_exchanged,
                    'currency' => $currency,
                    'status' => 0,
                    // 'completed_at' => Carbon::now()->addSeconds($setting->gbp_black_market_counter)
                    'completed_at' => Carbon::now()->addHours($setting->gbp_black_market_counter)
                ];
            }
        }
        // return $black_market_data;
        try {
            DB::transaction(function () use ($user, $user_data, $black_market_data) {
                $user->update($user_data);
                $black_market_log = BlackmarketLog::create($black_market_data);
                Mail::to($user->email)->send(new GeneralEmail($user->name, 'Black Market Sell request of ' . $black_market_log->get_amount_sold . ' is pending<br>Thanks for working with us.', 'Black Market Sell Request is pending', 1));
            });
            return redirect()->route('user.sell_to_blackmarket')->with('success', 'Black Market Sell request is placed.');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function get_amount_exchanged(Request $request)
    {
        $market_price = MarketPrice::query();
        if ($request->currency == 'usd') {
            $market_price = $market_price->where('symbol', '$');
        } else {
            $market_price = $market_price->where('symbol', '£');
        }
        $market_price = $market_price->first();
        $amount_exchanged = $market_price->black_market_rate * $request->amountSold;
        return $amount_exchanged;
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
        if ($request->new_pin == '000000') {
            return back()->with('warning', 'Your new pin cannot be "000000"');
        }
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

    public function thankyou()
    {
        return view('user.thankyou');
    }

    public function referral()
    {
        $downlines = User::select('id', 'username', 'email')->withOnly('downline_referral_log')->where('parent_id', auth()->user()->id)->get();
        // return $downlines;
        return view('user.referrals', compact('downlines'));
    }

    public function exclusive_offers()
    {
        $page = ContentPage::where('key', 'exclusive_offers')->first();
        // return $page;
        return view('user.exclusive_offers', compact('page'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/app/login');
    }
}
