<?php

namespace Ngeblog\User\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChangeProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('user::user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
                        'email' => [
                            'required',
                            'email',
                            Rule::unique('users')->ignore($user)
                        ],
                        'name' => 'required',
                    ]);

        $user->update($data);

        return redirect()->back()->with('status', 'The profile has been updated.');
    }
}
