<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Patient;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\MedicationSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class MedicationScheduleController extends Controller
{
    public function index(): View
    {
        $schedules = MedicationSchedule::with(['patient', 'creator'])
            ->latest()
            ->paginate(10);

        return view('medication_schedules.index', compact('schedules'));
    }

    public function create(): View
    {
        $patients = Patient::where('is_active', true)->get();
        return view('medication_schedules.create', compact('patients'));
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Durasi (Tetap)
        if ($request->duration_days > 31) {
            return back()->withErrors(['duration_days' => 'Durasi maksimal 31 hari'])->withInput();
        }

        // 2. Business Rule: Cek Jadwal Aktif Pasien (BARU DITAMBAHKAN)
        // Tujuan: Mencegah dua jadwal aktif untuk satu pasien.
        $patientId = $request->patient_id;

        // Cek apakah ada jadwal yang aktif (is_active=true & status=0) DAN
        // end_date-nya BELUM terlewat hari ini.
        $activeSchedule = MedicationSchedule::where('patient_id', $patientId)
            ->where('is_active', true)
            ->where('status', 0)
            ->get()
            ->filter(function ($schedule) {
                // Gunakan Helper getEndDateAttribute dari Model
                return $schedule->end_date->greaterThanOrEqualTo(Carbon::today());
            })
            ->first();

        if ($activeSchedule) {
            $endDate = $activeSchedule->end_date->format('d M Y');
            return back()->with('error', "Pasien ini masih memiliki jadwal aktif hingga {$endDate}. Mohon batalkan jadwal lama terlebih dahulu.")->withInput();
        }

        // 3. Eksekusi Create (Tetap)
        $schedule = MedicationSchedule::create([
            'patient_id' => $request->patient_id,
            'time_of_day' => $request->time_of_day,
            'duration_days' => $request->duration_days,
            'start_date' => $request->start_date,
            'notes' => $request->notes,
            'is_active' => true,
            'version' => 1,
            'status' => 0,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('medication.schedules.index')
            ->with('success', 'Jadwal obat berhasil dibuat.');
    }

    public function show(MedicationSchedule $schedule): View
    {
        $schedule->load(['patient', 'logs.patient']);
        return view('medication_schedules.show', compact('schedule'));
    }

    public function cancel(Request $request, MedicationSchedule $schedule): RedirectResponse
    {
        $request->validate([
            'cancellation_reason' => ['required', 'string'],
        ]);

        $schedule->update([
            'is_active' => false,
            'status' => 1,
            'cancelled_by' => auth()->id(),
            'cancellation_reason' => $request->cancellation_reason,
            'cancelled_at' => now(),
            'updated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Jadwal obat berhasil dibatalkan.');
    }

    public function destroy(MedicationSchedule $schedule): RedirectResponse
    {
        // Business Rule: Hanya bisa hapus jika belum ada log (Tetap)
        if ($schedule->logs()->exists()) {
            return back()->with('error', 'Jadwal ini sudah memiliki bukti konfirmasi atau log obat. Tidak bisa dihapus.');
        }

        // Penghapusan Permanen (Hard Delete)
        $schedule->delete();

        // Fix: Mengembalikan back() dengan session 'success'
        // Tujuan: Memastikan pesan sukses muncul di view (index) setelah penghapusan
        return back()->with('success', 'Jadwal obat berhasil dihapus.');
    }
}
