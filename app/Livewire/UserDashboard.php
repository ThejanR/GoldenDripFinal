<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product; // Import the Model

class UserDashboard extends Component
{
    public $heroTitle = "Experience the Perfect Brew";
    public $heroSubtitle = "Start your day with the finest selection of artisanal coffees, roasted to perfection and brewed with passion.";
    
    public $stats = [];
    public $siteInfo = [];
    public $featuredDrinks = [];

    public function mount()
    {
        // 1. Site Info (Still static for now)
        $this->siteInfo = [
            'address' => '123 Coffee Street, Colombo 07',
            'phone' => '+94 11 234 5678',
            'email' => 'hello@goldendrip.com',
            'hours' => 'Mon-Sun: 7:00 AM - 10:00 PM',
        ];

        // 2. Dynamic Stats
        $this->stats = [
            ['number' => '5000+', 'label' => 'Happy Customers'],
            // 👇 MAGIC: Automatically counts your actual products!
            ['number' => Product::count() . '+', 'label' => 'Coffee Varieties'], 
            ['number' => '15+', 'label' => 'Years Experience'],
        ];

        // 3. Fetch Featured Drinks
        // We specifically look for these 3 bestsellers to keep your design perfect
        $this->featuredDrinks = Product::whereIn('name', ['Golden Latte', 'Cappuccino', 'Caffè Latte'])->get();

        // Safety Check: If those names don't exist, just grab the first 3 items
        if ($this->featuredDrinks->isEmpty()) {
            $this->featuredDrinks = Product::take(3)->get();
        }
    }

    public function render()
    {
        return view('livewire.user-dashboard')->layout('layouts.app');
    }
}