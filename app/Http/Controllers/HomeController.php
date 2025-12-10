<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view("course");
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
