<?php

namespace Ngeblog\User\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('user::user.password.edit');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
                        'old_password' => 'required|current_password:web',
                        'password' => 'required|confirmed',
                        'password_confirmation' => 'required',
                    ]);

        $user = Auth::user();

        $user->password = Hash::make($data['password']);

        $user->save();

        return redirect()->back()->with('status', 'The password has been updated.');
    }
}
