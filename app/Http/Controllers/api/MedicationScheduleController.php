<?php

namespace App\Http\Controllers\Api;

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

        return response()->json([
            'meta' => ['code' => 201, 'status' => 'success', 'message' => 'Konfirmasi berhasil'],
            'data' => new MedicationLogResource($log),
        ], 201);
    }
}
