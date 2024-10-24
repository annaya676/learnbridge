<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'course_id', 'module_name', 'description', 'duration', 'video', 'document', 'status', 'created_at', 'updated_at'
    ];



}
