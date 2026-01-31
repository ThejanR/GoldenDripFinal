<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{
    public $email;
    public $password;

    public function login()
    {
        // 1. Validate Input
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Attempt Login with 2FA Support
        $user = \App\Models\User::where('email', $this->email)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
            
            // 3. Security Check: Is this actually a User?
            if ($user->user_type !== 'user') {
                session()->flash('error', 'This login form is for Standard Users only.');
                return;
            }

            // 4. Check for Two-Factor Authentication
            if ($user->two_factor_secret && $user->two_factor_confirmed_at) {
                session()->put([
                    'login.id' => $user->getKey(),
                    'login.remember' => false,
                ]);
                
                return redirect()->route('two-factor.login');
            }

            // 5. Success! No 2FA, Log them in
            Auth::login($user);
            session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 6. Handle Failure
        session()->flash('error', 'Invalid login credentials');
    }

    public function render()
    {
        return view('livewire.user-login')->layout('layouts.guest');
    }
}