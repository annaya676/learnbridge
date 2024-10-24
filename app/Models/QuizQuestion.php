<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'course_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'status', 'created_at', 'updated_at'
    ];


}
