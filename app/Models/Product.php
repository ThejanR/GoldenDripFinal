<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Allow these fields to be filled
    protected $fillable = [
    'name',
    'price',
    'category_id',
    'description',
    'short_description', 
    'image',
    'badge',             
    'rating',            
    'sort_order',        
    'is_featured',       
    'is_available',
];
    // Relationship: A Product belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}