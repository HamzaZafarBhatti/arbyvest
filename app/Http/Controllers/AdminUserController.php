<?php

namespace App\Http\Controllers;

use App\Events\AccountVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class AdminUserController extends Controller
{
    public function index()
    {
        //
        $roleIds = config('app.userVendorRoleIds');
        $roleIds = explode(',', $roleIds);
        $records = User::with("roles")->whereHas("roles", function($q) use ($roleIds) {
            $q->whereIn("id", $roleIds);
        })->latest('id')->get();
        return view('admin.users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $user_document_url = asset($user->get_user_document);
        $ext = pathinfo($user_document_url);
        if(isset($ext['extension'])) {
            $ext = $ext['extension'];
        } else {
            $ext = null;
        }
        return view('admin.users.edit', compact('user', 'ext', 'user_document_url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        try {
            $data = $request->except('_token', '_method');
            $user->update($data);
            return redirect()->route('admin.users.index')->with('success', 'User updated!');
        } catch (\Throwable $th) {
            Log::error('Error! '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        try {
            $user->delete();
            return back()->with('deleted', 'User deleted!');
        } catch (\Throwable $th) {
            Log::error('Error! '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function makeVendor($id)
    {
        try {
            $user = User::find($id);
            $user->assignRole('Vendor');
            return back()->with('success', 'User has become vendor!');
        } catch(Throwable $th) {
            Log::error('Error: '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function do_verify_account(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $user->update([
                'is_verified' => 1
            ]);
            event(new AccountVerification($user));
            return back()->with('success', 'User has been verified!');
        } catch(Throwable $th) {
            Log::error('Error: '.$th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }
}
