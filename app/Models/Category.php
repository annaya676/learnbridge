<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','image'];

    // Define a relationship for sub-categories
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    
}
