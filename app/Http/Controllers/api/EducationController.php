<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EducationController extends Controller
{
    public function index()
    {
        try {
            // PASTIKAN NAMA TABEL & KOLOM SESUAI DATABASE KAMU
            // Tabel: 'education' (bukan 'articles')
            // Kolom Status: 'is_active' (bukan 'is_published')

            $articles = DB::table('education')
                ->where('is_active', 1)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'meta' => ['code' => 200, 'status' => 'success'],
                'data' => $articles->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        // Format Tanggal
                        'date' => Carbon::parse($item->created_at)->translatedFormat('d M Y'),
                        'content' => $item->content,
                        // Mapping image_path database ke JSON key 'image_url'
                        // Menggunakan helper url() agar jadi link lengkap (http://...)
                        'image_url' => $item->image_path ? url('storage/' . $item->image_path) : null,
                    ];
                })
            ]);
        } catch (\Exception $e) {
            // Ini biar kita tau kalau ada error di server
            return response()->json([
                'meta' => ['code' => 500, 'status' => 'error'],
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function incrementView($id)
    {
        // Cek apakah artikel ada
        $exists = DB::table('education')->where('id', $id)->exists();

        if ($exists) {
            // Increment kolom view_count
            DB::table('education')->where('id', $id)->increment('view_count');

            return response()->json([
                'meta' => ['code' => 200, 'status' => 'success'],
                'message' => 'View count updated'
            ]);
        }

        return response()->json(['message' => 'Artikel tidak ditemukan'], 404);
    }
}
