<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'duration_hours', 'is_active', 'sertificate_template', 'user_id', 'img'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Bu kursga ro'yxatdan o'tgan talabalar
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student')
            ->withTimestamps();
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    // app/Models/Course.php ichiga qo'shing:

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
