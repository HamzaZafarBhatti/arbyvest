<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankUser;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Image;
use Throwable;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        $user_document_url = asset($user->get_user_document);
        $ext = pathinfo($user_document_url);
        if(isset($ext['extension'])) {
            $ext = $ext['extension'];
        } else {
            $ext = null;
        }
        return view('user.profile.edit', [
            'user' => $user,
            'ext' => $ext,
            'user_document_url' => $user_document_url,
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ]);
        $user = $request->user();
        $data = $request->only('name', 'phone');
        if ($image = $request->file('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $filename = 'image_' . time() . '.' . $ext;
            $location =  $user->getPhotoPath() . $filename;
            Image::make($image)->save($location);
            $data['image'] = $filename;
        }
        if ($user->image) {
            unlink($user->getPhotoPath() . $user->image);
        }
        // return $data;
        $request->user()->fill($data);

        $request->user()->save();

        return Redirect::route('user.profile.edit')->with('success', 'Profile updated.');
    }
    public function create_bank_details()
    {
        $banks = Bank::where('is_active', 1)->get();
        $user_bank = BankUser::where('user_id', auth()->user()->id)->first();
        return view('user.profile.bank_details', [
            'banks' => $banks,
            'user_bank' => $user_bank,
        ]);
    }
    public function edit_bank_details($id)
    {
        $banks = Bank::where('is_active', 1)->get();
        $user_bank = BankUser::find($id);
        if($user_bank->user_id != auth()->user()->id) {
            return back()->with('warning', 'Please edit your bank details');
        }
        return view('user.profile.edit_bank_details', [
            'banks' => $banks,
            'user_bank' => $user_bank,
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_bank_details(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'account_type' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|unique:bank_users,account_number',
        ]);
        try {
            $data = $request->except('_token');
            $data['user_id'] = $request->user()->id;
            $bank_user = BankUser::create($data);
            return redirect()->route('user.edit_bank_details', $bank_user->id)->with('success', 'Bank Details added.');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }
    public function update_bank_details(Request $request, $id)
    {
        $request->validate([
            'bank_id' => 'required',
            'account_type' => 'required',
            'account_name' => 'required',
            'account_number' => ['required',Rule::unique('bank_users', 'account_number')->ignore($id)],
        ]);
        try {
            $data = $request->except('_token', '_method');
            $bank_user = BankUser::find($id);
            if($bank_user->user_id != auth()->user()->id) {
                return back()->with('warning', 'Please update your bank details');
            }
            $bank_user->update($data);
            return redirect()->route('user.edit_bank_details', $bank_user->id)->with('success', 'Bank Details added.');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function verify_account()
    {
        $documentTypes = DocumentType::whereIsActive(1)->get();
        return view('user.profile.verify_account', compact('documentTypes'));
    }

    public function do_verify_account(Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->only('birthdate', 'document_type_id');
            if ($image = $request->file('document_pic')) {
                $ext = $request->document_pic->getClientOriginalExtension();
                $filename = 'document_pic_' . time() . '.' . $ext;
                $location =  $user->getPhotoPath() . $filename;
                if ($ext == 'pdf') {
                    move_uploaded_file($request->document_pic, $location);
                } else {
                    Image::make($image)->save($location);
                }
                $data['document_pic'] = $filename;
            }
            if ($image = $request->file('selfie')) {
                $ext = $request->selfie->getClientOriginalExtension();
                $filename = 'selfie_' . time() . '.' . $ext;
                $location =  $user->getPhotoPath() . $filename;
                Image::make($image)->save($location);
                $data['selfie'] = $filename;
            }
            if ($user->document_pic) {
                unlink($user->getPhotoPath() . $user->document_pic);
            }
            if ($user->selfie) {
                unlink($user->getPhotoPath() . $user->selfie);
            }
            $user->update($data);
            return back()->with('success', 'Request Submitted for Account Verification!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }
}
