<?php

namespace App\Http\Controllers;

use App\Events\GeneralEmailNotification;
use App\Mail\GeneralEmail;
use App\Models\Setting;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::with('user', 'bank_user')->latest('id')->get();
        return view('admin.withdraws.index', compact('withdraws'));
    }
    public function unpaid()
    {
        $withdraws = Withdraw::with('user', 'bank_user')->where('status', 0)->latest('id')->get();
        return view('admin.withdraws.index', compact('withdraws'));
    }
    public function approve(Request $request)
    {
        try {
            //code...
            $data = Withdraw::findOrFail($request->id);
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
                    return back()->with('alert', 'The withdrawal amount is less than your input amount!');
                }
                $remainder_amount = $data->amount - $payment_value;
            }
            $user->update([
                'show_popup' => 1,
                'balance' => $user->balance + $remainder_amount
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
            Mail::to($user->email)->send(new GeneralEmail($user->username, 'Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' has been approved<br>Thanks for working with us.', 'Withdraw Request has been approved', 1));

            // Notification::create([
            //     'user_id' => $user->id,
            //     'title' => 'Affliate Balance WITHDRAWAL - SUCCESSFUL  - NGN' . $data->amount,
            //     'msg' => 'Your Withdrawal Request from your Affliate Balance has been APPROVED. Kindly POST your Payment Credit ALERT!',
            //     'is_read' => 0
            // ]);
            return redirect()->route('admin.withdraws.index')->with('success', 'Request was Successfully approved!');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return redirect()->route('admin.withdraws.index')->with('error', 'Problem With Approving Request');
        }
    }

    public function approved()
    {
        $withdraws = Withdraw::with('user', 'bank_user')->whereStatus('1')->latest('id')->get();
        return view('admin.withdraws.approved', compact('withdraws'));
    }

    public function affliate_withdraw_approve_multi(Request $request)
    {
        // return $request;

        $set = Setting::first();
        foreach ($request->ids as $id) {
            $data = Withdraw::findOrFail($id);
            $user = User::find($data->user_id);
            $user->update(['show_popup' => 1]);
            $res = $data->update(['status' => '1']);
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
            // return 'out';
            // if ($set->email_notify == 1) {
            //     $temp = Etemplate::first();
            //     Mail::to($user->email)->send(new GeneralEmail($temp->esender, $user->username, 'Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' has been approved<br>Thanks for working with us.', 'Withdraw Request has been approved'));
            // }
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Affliate Balance WITHDRAWAL - SUCCESSFUL  - NGN' . $data->amount,
                'msg' => 'Your Withdrawal Request from your Affliate Balance has been APPROVED. Kindly POST your Payment Credit ALERT!',
                'is_read' => 0
            ]);
        }
        return true;
    }

    public function delete($id)
    {
        $data = Withdraw::findOrFail($id);
        // return json_encode($data->status == '0');
        if ($data->status == '0') {
            return back()->with('alert', 'You cannot delete an unpaid withdraw request');
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
            $data = Withdraw::findOrFail($id);
            $user = User::find($data->user_id);
            $set = Setting::first();
            $res = $data->update(['status' => '2']);
            $user->update(['balance' => $user->balance + $data->amount]);
            // if ($set->email_notify == 1) {
            //     $temp = Etemplate::first();
            // }
            Mail::to($user->email)->send(new GeneralEmail($user->username, 'Withdrawal request of ₦' . substr($data->amount, 0, 9) . ' has been declined<br>Thanks for working with us.', 'Withdraw Request has been declined'));
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
            return redirect()->route('admin.withdraws.index')->with('error', 'Problem With Approving Request');
        }
    }

    public function declined()
    {
        $data['withdraws'] = Withdraw::with('user')->whereStatus('2')->latest('id')->get();
        return view('admin.withdraws.declined', $data);
    }
}
