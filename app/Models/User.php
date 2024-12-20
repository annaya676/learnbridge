<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'candidate_id',
        'name',
        'email',
        'phone',
        'designation',
        'level',
        'lob_id',
        'department',
        'doj',
        'joiner_status',
        'gender',
        'sub_lob',
        'college_name',
        'location',
        'specialization',
        'college_location',	
        'offer_release_spoc',
        'trf',
        'revokes',
        'sme_submission_date',
        'password',
        'token',
        'qualification',
        'college_tier',
        'status',
        'isterm',
        'uploader',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lob(): BelongsTo
    {
        return $this->belongsTo(Lob::class, 'lob_id', 'id'); 
    }


    public function createdby(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'uploader', 'id'); 
    }


   
}
