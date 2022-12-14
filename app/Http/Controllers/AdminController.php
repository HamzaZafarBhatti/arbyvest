<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TransferBalanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.auth.login');
    }

    public function do_login(Request $request)
    {
		if (Auth::attempt([
			'email' => $request->email,
			'password' => $request->password,
		])) {
			return redirect()->route('admin.dashboard');
		}else{
			return back()->with('error', 'Oops! You have entered invalid credentials');
		}
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('admin.login')->with('success', 'Just Logged Out!');
    }
    
    public function user_transfer_balance_logs()
    {
        $logs = TransferBalanceLog::with('vendor', 'user')->latest('id')->get();
        return view('admin.transfer.transfer_balance', compact('logs'));
    }
}
