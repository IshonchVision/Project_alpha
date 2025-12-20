<?php
namespace App\Http\Controllers;
use App\Models\Course;

class HomeController extends Controller
{
    public function home()
    {
        return view("index");
    }
    public function about()
    {
        return view("about");
    }
    public function contact()
    {
        return view("contact");
    }

    public function course()
    {
        $courses = Course::withCount('videos')->get();

        return view("course", compact('courses'));
    }

    public function detail()
    {
        return view("detail");
    }
    public function feature()
    {
        return view("feature");
    }

    public function team()
    {
        return view("team");
    }

    public function testimonial()
    {
        return view("testimonial");
    }
}
