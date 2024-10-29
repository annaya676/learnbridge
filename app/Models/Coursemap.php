<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coursemap extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'user_id', 'course_id', 'lob_id', 'quiz_status', 'quiz_status', 'assignment_status', 'assignment_file', 'assignment_remark', 'assignment_download_status', 'assignment_sme_file', 'is_complete', 'is_read_video', 'is_read_docs', 'assignment_upload_date', 'created_at', 'updated_at'	
    ];

    // public function course(): BelongsTo
    // {
    //     return $this->belongsTo(Course::class, 'course_id', 'id')->active(); 
    // }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id'); 
    // }

    public function lob(): BelongsTo
    {
        return $this->belongsTo(Lob::class, 'lob_id', 'id'); 
    }
   
    public function sme(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assignment_assign', 'id'); 
    }


    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }
    public function course()
    {
        return $this->belongsTo(Course::class); 
    }

   

}
