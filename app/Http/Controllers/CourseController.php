<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function my_course()
    {
        return view('courses.my_course');
    }
}
