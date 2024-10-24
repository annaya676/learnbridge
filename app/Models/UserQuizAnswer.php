<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserQuizAnswer extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'course_id', 'user_id', 'question_id', 'answer'
    ];

    public function questions(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id', 'id'); 
    }


}
