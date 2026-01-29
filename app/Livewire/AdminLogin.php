<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Component
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

        // 2. Attempt Login
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            
            // 3. Security Check: Use the centralized isAdmin check
            // This replaces the hardcoded 'admin@gmail.com' check that was causing conflicts
            if (!auth()->user()->isAdmin()) {
                Auth::logout(); 
                session()->flash('error', 'Unauthorized. This area is for Admins only.');
                return;
            }

            // 4. Success! Regenerate session and redirect to Admin Dashboard
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // 5. Handle Failure
        session()->flash('error', 'Invalid admin credentials');
    }

    public function render()
    {
        return view('livewire.admin-login')->layout('layouts.guest');
    }
}