<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        $educations = Education::latest()->paginate(10);
        return view('educations.index', compact('educations'));
    }

    public function create(): View
    {
        return view('educations.create');
    }

    public function edit(Education $education): View
    {
        return view('educations.edit', compact('education'));
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();
        return back()->with('success', 'Artikel edukasi berhasil dihapus.');
    }


    public function store(StoreEducationRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'is_active' => true,
            'view_count' => 0,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ];

        // Handle upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('educations', 'public');
            $data['image_path'] = $path;
        }

        Education::create($data);
        return redirect()->route('educations.index')->with('success', 'Artikel edukasi berhasil ditambahkan.');
    }

    public function update(UpdateEducationRequest $request, Education $education): RedirectResponse
    {
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'updated_by' => auth()->id(),
        ];

        // Handle upload (hapus gambar lama jika perlu)
        if ($request->hasFile('image')) {
            // Opsional: hapus file lama
            if ($education->image_path) {
                Storage::disk('public')->delete($education->image_path);
            }
            $path = $request->file('image')->store('educations', 'public');
            $data['image_path'] = $path;
        }

        $education->update($data);
        return redirect()->route('educations.index')->with('success', 'Artikel edukasi berhasil diperbarui.');
    }
}
