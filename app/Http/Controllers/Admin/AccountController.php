<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Show the page to manage account
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('account.index', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update the user account
     *
     * @param Request $request
     * @return Redirect
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 
                Rule::unique('users')->ignore($request->user()->id),    
            ],
            'password' =>['nullable', 'confirmed', Password::min(8)]
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ( !empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return back()->with('success', __('Your account has been updated!'));
    }
}
