<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(): View
    {
        $patients = Patient::with('creator')
            ->latest()
            ->paginate(10);
        return view('patient.index', compact('patients'));
    }

    public function create(): View
    {
        return view('patient.create');
    }

    public function store(StorePatientRequest $request): RedirectResponse
    {
        Patient::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => true,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('patient.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit(Patient $patient): View
    {
        return view('patient.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient): RedirectResponse
    {
        $patient->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('patient.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->update([
            'is_active' => false,
            'updated_by' => auth()->id(),
        ]);
        $patient->delete();

        return back()->with('success', 'Pasien berhasil dinonaktifkan.');
    }
}
