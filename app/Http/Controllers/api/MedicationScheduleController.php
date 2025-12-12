<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MedicationLog;
use App\Models\MedicationSchedule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\MedicationLogResource;
use App\Http\Requests\StoreMedicationLogRequest;

class MedicationScheduleController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $today = now()->format('Y-m-d');

        // 1. Ambil Jadwal Aktif
        $schedule = MedicationSchedule::where('patient_id', $user->id)
            ->where('is_active', 1)
            ->first();

        // 2. CEK LOG HARI INI (PENTING!)
        $todayLog = null;
        if ($schedule) {
            $todayLog = MedicationLog::where('schedule_id', $schedule->id)
                ->where('log_date', $today)
                ->where('is_taken', 1)
                ->first();
        }

        // 3. Ambil Riwayat
        $logs = MedicationLog::where('created_by', $user->id)
            ->orderBy('log_date', 'desc')
            ->limit(7)
            ->get();

        return response()->json([
            'meta' => ['code' => 200, 'status' => 'success'],
            'data' => [
                'schedule' => $schedule ? new ScheduleResource($schedule) : null,
                'history' => MedicationLogResource::collection($logs),
                // KIRIM STATUS HARI INI
                'today_status' => [
                    'is_taken' => $todayLog ? true : false,
                    'taken_at' => $todayLog ? $todayLog->taken_at : null,
                ]
            ]
        ]);
    }

    public function storeLog(StoreMedicationLogRequest $request)
    {
        $user = $request->user();
        $schedule = MedicationSchedule::find($request->schedule_id);
        // 1. Upload File ke Storage
        if ($request->hasFile('photo')) {
            // Simpan di folder: storage/app/public/logs
            $path = $request->file('photo')->store('logs', 'public');
        } else {
            return response()->json(['message' => 'Foto wajib diupload'], 422);
        }

        // 2. Simpan ke Database
        $log = MedicationLog::create([
            'schedule_id' => $request->schedule_id,
            'patient_id'  => $user->id, // atau created_by sesuai strukturmu
            'created_by'  => $user->id,
            'log_date'    => now()->format('Y-m-d'),
            'taken_at'    => now(),
            'is_taken'    => 1, // Konfirmasi = Sudah Minum
            'img_path'    => $path, // Path gambar yg baru diupload
            'notes'       => $request->notes,
        ]);

        $today = Carbon::today()->format('Y-m-d');
        $endDate = $schedule->end_date->format('Y-m-d');

        // Jika hari ini ADALAH hari terakhir jadwal DAN jadwal masih berstatus "Berlangsung" (0)
        if ($today === $endDate && $schedule->status === 0) {

            // Perbarui Status Jadwal menjadi Selesai (1) dan nonaktifkan
            $schedule->update([
                'is_active' => false,
                'status' => 1,
                // Opsional: Mencatat siapa yang menyelesaikan
                'updated_by' => $user->id,
            ]);

            // Tambahkan pesan khusus untuk frontend jika diperlukan,
            // tapi kita akan handle di Flutter, jadi cukup di log backend.
            logger()->info("Jadwal ID {$schedule->id} pasien {$user->id} berhasil diselesaikan otomatis.");
        }

        return response()->json([
            'meta' => ['code' => 201, 'status' => 'success', 'message' => 'Konfirmasi berhasil'],
            'data' => new MedicationLogResource($log),
        ], 201);
    }

    public function toggleStatus(Request $request, $id)
    {
        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $schedule = MedicationSchedule::where('id', $id)
            ->where('patient_id', $request->user()->id)
            ->first();

        if (!$schedule) {
            return response()->json([
                'meta' => ['code' => 404, 'status' => 'error', 'message' => 'Jadwal tidak ditemukan']
            ], 404);
        }

        $schedule->update([
            'is_active' => $request->is_active,
            'updated_by' => $request->user()->id // Mencatat siapa yang mengubah
        ]);

        return response()->json([
            'meta' => ['code' => 200, 'status' => 'success', 'message' => 'Status alarm berhasil diperbarui'],
            'data' => new ScheduleResource($schedule)
        ]);
    }
}
