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

        // 2. Attempt Login (Safe Method)
        // Instead of calling the API, we ask Laravel directly: "Does this password match?"
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            
            // 3. Security Check: Is this actually a User?
            if (auth()->user()->user_type !== 'user') {
                Auth::logout(); // Kick them out if they are an Admin
                session()->flash('error', 'This login form is for Standard Users only.');
                return;
            }

            // 4. Success! Redirect to dashboard
            session()->regenerate(); // specific security practice for logins
            return redirect()->route('dashboard');
        }

        // 5. Handle Failure
        session()->flash('error', 'Invalid login credentials');
    }

    public function render()
    {
        return view('livewire.user-login')->layout('layouts.guest');
    }
}