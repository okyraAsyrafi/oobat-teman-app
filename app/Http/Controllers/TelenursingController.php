<?php

namespace App\Http\Controllers;

use App\Models\WhatsappContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TelenursingController extends Controller
{
    public function index(): View
    {
        // Ambil maksimal 3 kontak, urutkan berdasarkan order_index
        $existing = WhatsappContact::where('is_active', true)
            ->whereIn('order_index', [1, 2, 3])
            ->get()
            ->keyBy('order_index'); // jadi: [1 => contact, 3 => contact]

        $contacts = collect();
        for ($i = 1; $i <= 3; $i++) {
            if ($existing->has($i)) {
                $contacts->push($existing->get($i));
            } else {
                // Buat placeholder
                $contacts->push(new WhatsappContact([
                    'id' => null,
                    'name' => "Petugas $i",
                    'phone' => '',
                    'order_index' => $i,
                    'is_active' => true,
                ]));
            }
        }

        return view('telenursing.index', compact('contacts'));
    }

    public function update(Request $request): RedirectResponse
    {
        $index = (int) $request->submit_index; // 1, 2, atau 3
        if ($index < 1 || $index > 3) {
            abort(400, 'Invalid index');
        }

        // Ambil semua nomor aktif (kecuali diri sendiri)
        $existingPhones = WhatsappContact::where('is_active', true)
            ->where('name', '!=', "Petugas $index")
            ->pluck('phone')
            ->filter()
            ->toArray();

        // Validasi hanya untuk index yang dikirim
        $validator = Validator::make($request->all(), [
            "name_$index" => ['required', 'string', 'max:255'],
            "phone_$index" => [
                'required',
                'regex:/^08[0-9]{8,12}$/',
                Rule::notIn($existingPhones),
            ],
        ], [
            "phone_$index.regex" => 'Nomor harus diawali dengan 08 dan diikuti 8–12 digit angka.',
            "phone_$index.not_in" => 'Nomor ini sudah digunakan oleh petugas lain.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Simpan hanya data yang divalidasi
        $contact = WhatsappContact::updateOrCreate(
            ['name' => "Petugas $index"],
            [
                'phone' => $request->input("phone_$index"),
                'is_active' => true,
                'updated_by' => auth()->id(),
                'created_by' => auth()->id(),
                'order_index' => $index,
            ],
        );

        return back()->with('success', "Nomor Petugas $index berhasil diperbarui.");
    }
}
