<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Image;

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
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
            $ext = $request->document_pic->getClientOriginalExtension();
            // return $ext;
            if ($image = $request->file('document_pic')) {
                $filename = 'document_pic_' . time() . '.' . $ext;
                $location =  $user->getPhotoPath() . $filename;
                Image::make($image)->save($location);
                $data['document_pic'] = $filename;
            }
            if ($image = $request->file('selfie')) {
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
