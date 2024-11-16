<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showAuthPage()
    {
        return view("auth.auth", ['hideNavbar' => true]);
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('/');
    }

    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => ['required', 'regex:/^(?:\+62|62|0)[2-9][0-9]{7,12}$/'],
            'image_link' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'phone_number.regex' => 'The phone number must be a valid Indonesian phone number.',
        ]);

        $imageLink = null;
        if ($request->hasFile('image_link')) {
            $image = $request->file('image_link');
            $imageName = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imageLink = 'profile_images/' . $imageName;
            $image->storeAs('profile_images', $imageName, 'private');
        }

        $type = "customer";
        $name = $request->first_name . " " . $request->last_name;
        $user = User::create([
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'image_link' => $imageLink,
            'type' => $type
        ]);

        Auth::login($user);

        return redirect()->intended('/');

    }
}
