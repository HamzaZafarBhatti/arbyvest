<?php

namespace App\Http\Controllers;

use App\Mail\GeneralEmail;
use App\Models\ReferralWithdrawLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReferralWithdrawController extends Controller
{
    public function index()
    {
        $withdraws = ReferralWithdrawLog::with('user', 'bank_user')->latest('id')->get();
        return view('admin.referral_withdraws.index', compact('withdraws'));
    }
    public function unpaid()
    {
        $withdraws = ReferralWithdrawLog::with('user', 'bank_user')->where('status', 0)->latest('id')->get();
        return view('admin.referral_withdraws.index', compact('withdraws'));
    }
    public function approved()
    {
        $withdraws = ReferralWithdrawLog::with('user', 'bank_user')->whereStatus('1')->latest('id')->get();
        return view('admin.referral_withdraws.approved', compact('withdraws'));
    }
    public function declined()
    {
        $withdraws = ReferralWithdrawLog::with('user')->whereStatus('2')->latest('id')->get();
        return view('admin.referral_withdraws.declined', compact('withdraws'));
    }
    public function approve(Request $request)
    {
        try {
            //code...
            $data = ReferralWithdrawLog::findOrFail($request->id);
            $user = User::find($data->user_id);
            if ($request->payment_value) {
                $payment_value = $request->payment_value;
            } else {
                $payment_value = $data->amount;
            }
            // return $payment_value;
            $remainder_amount = 0;
            if ($request->payment == 1) {
                if ($payment_value > $data->amount) {
                    return back()->with('alert', 'The referral withdrawal amount is less than your input amount!');
                }
                $remainder_amount = $data->amount - $payment_value;
            }
            $user->update([
                'show_popup' => 1,
                'ref_ngn_wallet' => $user->ref_ngn_wallet + $remainder_amount
            ]);
            $res = $data->update([
                'status' => '1',
                'amount' => $payment_value
            ]);
            // $earner = TopEarner::where('user_id', $data->user_id)->where('type', 1)->first();
            // if (!$earner) {
            //     $earn_data = [
            //         'user_id' => $user->id,
            //         'name' => $user->name,
            //         'amount' => $data->amount,
            //         'status' => 1,
            //         'type' => 1
            //     ];
            //     // return 'if';
            //     $earner = TopEarner::create($earn_data);
            // } else {
            //     // return 'hello';
            //     $earner->amount += $data->amount;
            //     $earner->update(['amount' => $earner->amount]);
            // }
            // if ($set->email_notify == 1) {
            //     $temp = Etemplate::first();
            // }          
            Mail::to($user->email)->send(new GeneralEmail($user->name, 'Referral Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' has been approved<br>Thanks for working with us.', 'Withdraw Request has been approved', 1));

            // Notification::create([
            //     'user_id' => $user->id,
            //     'title' => 'Affliate Balance WITHDRAWAL - SUCCESSFUL  - NGN' . $data->amount,
            //     'msg' => 'Your Withdrawal Request from your Affliate Balance has been APPROVED. Kindly POST your Payment Credit ALERT!',
            //     'is_read' => 0
            // ]);
            return redirect()->route('admin.referral_withdraws.index')->with('success', 'Request was Successfully approved!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return redirect()->route('admin.referral_withdraws.index')->with('error', 'Problem With Approving Request');
        }
    }

    public function delete($id)
    {
        $data = ReferralWithdrawLog::findOrFail($id);
        // return json_encode($data->status == '0');
        if ($data->status == '0') {
            return back()->with('alert', 'You cannot delete an unpaid referral withdraw request');
        } else {
            $res =  $data->delete();
            if ($res) {
                return back()->with('success', 'Request was Successfully deleted!');
            } else {
                return back()->with('alert', 'Problem With Deleting Request');
            }
        }
    }

    public function decline($id)
    {
        try {
            //code...
            $data = ReferralWithdrawLog::findOrFail($id);
            $user = User::find($data->user_id);
            $set = Setting::first();
            $res = $data->update(['status' => '2']);
            $user->update(['ref_ngn_wallet' => $user->ref_ngn_wallet + $data->amount]);
            // if ($set->email_notify == 1) {
            //     $temp = Etemplate::first();
            // }
            Mail::to($user->email)->send(new GeneralEmail($user->name, 'Referral Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' has been declined<br>Thanks for working with us.', 'Withdraw Request has been declined', 1));
            // Notification::create([
            //     'user_id' => $user->id,
            //     'title' => 'Affliate Balance WITHDRAWAL - DECLINED - NGN' . $data->amount,
            //     'msg' => 'Your Withdrawal Request from your Affliate Balance has been DECLINED - Please update your Bank account and try again or contact Rubic Network Support.',
            //     'is_read' => 0
            // ]);
            return back()->with('success', 'Request was Successfully declined!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return redirect()->route('admin.referral_withdraws.index')->with('error', 'Problem With Approving Request');
        }
    }

}
