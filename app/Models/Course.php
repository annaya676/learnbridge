<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Authenticatable
{
    
    use HasFactory, Notifiable;


    protected $fillable = [
        'category_id', 'course_id', 'course_name ', 'description', 'image', 'sme_id', 'lob_id', 'assignment', 'status', 'created_at', 'updated_at'
    ];

    public function module(): HasMany
    {
        return $this->HasMany(Module::class, 'course_id', 'id');
    }

    public function quiz(): HasMany
    {
        return $this->HasMany(QuizQuestion::class, 'course_id', 'course_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function updateby(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'uploader', 'id'); 
    }

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id'); 
    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courseMaps()
    {
        return $this->hasMany(CourseMap::class);
    }
   
}

