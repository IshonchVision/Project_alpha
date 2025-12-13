<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'teacher_id',
        'subject',
        'level',
        'status',
        'start_date',
        'end_date',
        'lesson_time',
        'lesson_days',
        'duration_months',
        'max_students',
        'current_students',
        'monthly_fee',
        'room',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Teacher relationship
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Payments relationship
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // App/Models/Group.php


    public function students()
    {
        return $this->belongsToMany(User::class, 'group_student');
    }

    public function messages()
    {
        return $this->hasMany(GroupMessage::class, 'group_id');
    }
}
