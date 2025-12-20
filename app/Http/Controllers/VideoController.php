<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Video yuklash formasi (agar kerak bo'lsa)
     */
    public function create($courseId)
    {
         $course = Auth::user()->courses()->findOrFail($courseId);
        return view('teacher.videos.create', compact('course'));
    }

    /**
     * Yangi video yuklash
     */
    public function store(Request $request, $courseId)
    {
        $user = Auth::user();

        // Kurs o'qituvchiga tegishli ekanligini tekshirish
        $course = Course::where('id', $courseId)->where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:0',
            'video' => 'required|file|mimetypes:video/mp4,video/avi,video/mov,video/quicktime,video/webm|max:1024000', // 1GB gacha
        ]);

        try {
            DB::beginTransaction();

            // Video faylni saqlash
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('videos', $filename, 'public');

            // Video modelini yaratish
            $video = Video::create([
                'title' => $request->title,
                'description' => $request->description,
                'duration_seconds' => $request->duration_minutes ? $request->duration_minutes * 60 : null,
                'video_url' => 'storage/' . $path,
                'course_id' => $course->id,
                'user_id' => $user->id,
                'module_id' => null, // agar module kerak bo'lsa keyin qo'shiladi
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Video muvaffaqiyatli yuklandi!',
                    'video' => $video
                ]);
            }

            return redirect()->route('teacher.courses.show', $course->id)
                ->with('success', 'Video muvaffaqiyatli yuklandi!');

        } catch (\Exception $e) {
            DB::rollBack();

            // Faylni o'chirish (agar saqlangan bo'lsa)
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()->with('error', 'Video yuklashda xatolik: ' . $e->getMessage());
        }
    }

    /**
     * Video o'chirish
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $video = Video::findOrFail($id);

        if ($video->course->user_id !== $user->id) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Ruxsat yo\'q'], 403);
            }
            abort(403);
        }

        // Faylni o'chirish
        $filePath = str_replace('storage/', '', $video->video_url);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $video->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Video o\'chirildi']);
        }

        return back()->with('success', 'Video o\'chirildi');
    }
}