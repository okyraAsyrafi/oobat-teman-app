<?php

namespace App\Http\Controllers;

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
        // Validasi durasi
        if ($request->duration_days > 31) {
            return back()->withErrors(['duration_days' => 'Durasi maksimal 31 hari'])->withInput();
        }

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
        // Hanya bisa hapus jika belum ada log
        if ($schedule->logs()->exists()) {
            return back()->with('error', 'Jadwal ini sudah memiliki bukti konfirmasi. Tidak bisa dihapus.');
        }

        $schedule->delete();
        return back()->with('success', 'Jadwal obat berhasil dihapus.');
    }
}
