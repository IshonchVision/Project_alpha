<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    public function my_course()
    {
        $courses = Course::withCount('videos')->get();

        return view('courses.my_course', compact('courses'));
    }

    /**
     * Attempt to enter a course watching page — only for authenticated users.
     * Returns 401 JSON for AJAX guests, or redirects back with a flash error.
     */
    public function watch(Request $request)
    {
        if (! Auth::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Siz tizimga kirmagansiz. Iltimos, ro\'yxatdan o\'ting yoki tizimga kiring.'], 401);
            }

            return redirect()->back()->with('error', 'Siz tizimga kirmagansiz. Iltimos, tizimga kiring.');
        }

        // Logged in users are sent to their courses / viewing area
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'redirect' => route('my_course')]);
        }

        return redirect()->route('/my_course');
    }
}
