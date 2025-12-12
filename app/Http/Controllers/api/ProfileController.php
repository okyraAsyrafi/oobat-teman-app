<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Update data pasien yang sedang login (self-service).
     */
    public function update(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|string', // Terima format string dari Flutter
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'meta' => ['code' => 422, 'status' => 'error', 'message' => 'Validasi gagal'],
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Cari Pasien berdasarkan NIK (Kunci)
        $patient = Patient::where('nik', $request->nik)->first();

        if (!$patient) {
            return response()->json(['message' => 'Data pasien tidak ditemukan'], 404);
        }

        // 3. Konversi Tanggal Lahir (dari 'd MMMM yyyy' ke 'Y-m-d' DB)
        try {
            // Coba parsing format Indonesia yang dikirim Flutter (misal: "09 Oktober 1999")
            $formattedDob = Carbon::createFromFormat('d F Y', $request->date_of_birth, 'Asia/Jakarta')->toDateString();
        } catch (\Exception $e) {
            // Fallback jika format UI salah, coba parse format standar DB
            try {
                $formattedDob = Carbon::parse($request->date_of_birth)->toDateString();
            } catch (\Exception $e) {
                return response()->json(['message' => 'Format Tanggal Lahir tidak valid.'], 422);
            }
        }

        // 4. Update Data Pasien
        $patient->update([
            'name' => $request->name,
            'date_of_birth' => $formattedDob,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // 5. Update Nama di tabel User (Sinkronisasi)
        $user = User::find($patient->created_by);
        if ($user) {
            $user->update(['name' => $request->name]);
        }

        // 6. Kembalikan data Pasien terbaru
        return response()->json([
            'meta' => ['code' => 200, 'status' => 'success'],
            // Mengembalikan Model Patient (yang berisi NIK, DOB, Address terbaru)
            'data' => $patient->toArray(),
            'message' => 'Profil berhasil diperbarui'
        ]);
    }
}
