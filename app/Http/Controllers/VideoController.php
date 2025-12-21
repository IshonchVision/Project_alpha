<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function store(Request $request)
    {

        // 1️⃣ Validatsiya (PHP limitini tekshirish)
        $maxUploadSize = min(
            $this->parseSize(ini_get('upload_max_filesize')),
            $this->parseSize(ini_get('post_max_size')),
            1024 * 1024 * 1024 // 1 GB
        );

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'video'            => [
                'required',
                'file',
                'mimes:mp4,avi,mov,webm,mpg,mpeg',
                'max:' . ($maxUploadSize / 1024), // KB ga aylantirish
            ],
        ], [
            'video.max' => 'Video hajmi ' . $this->formatBytes($maxUploadSize) . ' dan oshmasligi kerak!'
        ]);

        $file = $request->file('video');

        if (!$file || !$file->isValid()) {
            return back()->with('error', 'Video fayl yuklanmadi yoki buzilgan.');
        }

        // 2️⃣ Manual hajm tekshirish
        if ($file->getSize() > $maxUploadSize) {
            return back()->with('error', 'Video hajmi ' . $this->formatBytes($maxUploadSize) . ' dan oshib ketdi!');
        }

        try {
            // 3️⃣ S3 mavjudligini tekshirish
            if (!config('filesystems.disks.s3')) {
                throw new \Exception('S3 disk sozlanmagan! .env faylini tekshiring.');
            }

            // 4️⃣ Test ulanish
            try {
                Storage::disk('s3')->exists('test'); // Connection test
            } catch (\Exception $e) {
                throw new \Exception('S3 ga ulanib bo\'lmadi: ' . $e->getMessage());
            }

            Log::info('Video yuklash boshlandi', [
                'file_size' => $file->getSize(),
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType()
            ]);

            // 5️⃣ S3 ga yuklash
            $fileName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());

            // MUHIM: putFileAs ishlatish (kattaroq fayllar uchun yaxshiroq)
            $path = Storage::disk('s3')->putFileAs('videos', $file, $fileName);

            if (!$path) {
                throw new \Exception('S3 ga yuklash muvaffaqiyatsiz tugadi!');
            }

            // 6️⃣ Yuklangani tekshirish
            if (!Storage::disk('s3')->exists($path)) {
                throw new \Exception('Fayl S3 ga yuklanmadi: ' . $path);
            }

            Log::info('Video S3 ga yuklandi', ['path' => $path]);

            // 7️⃣ Public qilish
            try {
                Storage::disk('s3')->setVisibility($path, 'public');
            } catch (\Exception $e) {
                Log::warning('Visibility xatosi: ' . $e->getMessage());
            }

            // 8️⃣ Bazaga saqlash
            $video = Video::create([
                'course_id'        => $course->$id,
                'user_id'          => Auth::id(),
                'title'            => $validated['title'],
                'description'      => $validated['description'] ?? null,
                'video_url'        => $path, // videos/1234567890_filename.mp4
                'duration_seconds' => $validated['duration_minutes'] * 60,
            ]);

            Log::info('Video bazaga saqlandi', ['video_id' => $video->id, 'path' => $path]);

            return back()->with('success', 'Video muvaffaqiyatli yuklandi! (S3: ' . $path . ')');
        } catch (\Throwable $e) {
            Log::error('Video yuklash xatosi', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

    private function parseSize($size)
    {
        $unit = strtoupper(substr($size, -1));
        $value = (int) substr($size, 0, -1);

        switch ($unit) {
            case 'G':
                return $value * 1024 * 1024 * 1024;
            case 'M':
                return $value * 1024 * 1024;
            case 'K':
                return $value * 1024;
            default:
                return (int) $size;
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
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
