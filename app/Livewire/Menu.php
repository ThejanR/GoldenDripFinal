<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class Menu extends Component
{
    public $menuItems = [];
    public $categories = [];
    
    public $activeCategory = 'all';
    public $search = ''; 

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function filter($categoryId)
    {
        // Sets the active category to the ID number passed from the button
        $this->activeCategory = $categoryId;
    }

    public function render()
    {
        $query = Product::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->activeCategory !== 'all') {
            // Filters using the numeric ID to match your database column
            $query->where('category_id', $this->activeCategory);
        }

        $this->menuItems = $query->get();

        return view('livewire.menu')->layout('layouts.app');
    }
}