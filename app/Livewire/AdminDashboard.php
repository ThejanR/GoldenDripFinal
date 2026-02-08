<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminDashboard extends Component
{
    public $users = [];

    public function mount()
    {
        // Only fetch users if the current person is actually an admin
        if (auth()->user()->user_type === 'admin') {
            $this->users = User::all();
        } else {
            $this->users = [];
        }
    }

    public function render()
    {
        return view('livewire.admin-dashboard')->layout('layouts.app');
    }
}