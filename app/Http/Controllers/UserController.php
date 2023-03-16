<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = $this->getUserInfo();

        return view('user.index', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = null;
        $token = PersonalAccessToken::findToken(session()->get('token'));
        if (!empty($token)) {
            $user = $token->tokenable;
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->birthday = $request->birthday ?? $user->birthday;
            $user->address = $request->address ?? $user->address;

            if ($request->old_password || $request->new_password || $request->new_password_confirmation) {
                $request->validate([
                    'old_password' => 'required',
                    'new_password' => 'required|confirmed',
                    'new_password_confirmation' => 'required',
                ]);
                if (!Hash::check($request->old_password, $user->password)) {
                    return redirect('/profile')->with('error', 'The old password you entered is incorrect.');
                }

                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect('/profile')->with('status', 'Profile updated successfully!');
            }

            return redirect('/profile')->with('status', 'Profile updated successfully!');
        }

        return redirect('/profile')->with('error', 'Unable to update profile.');
    }

}
