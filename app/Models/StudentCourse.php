<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $table = "course_student";
    protected $fillable = ['course_id' , 'user_id' , 'enrolled_at'];

}
