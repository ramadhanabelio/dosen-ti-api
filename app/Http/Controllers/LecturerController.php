<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    private $studyPrograms = [
        'Teknik Informatika',
        'Rekayasa Perangkat Lunak',
        'Keamanan Sistem Informasi'
    ];

    public function index()
    {
        $lecturers = Lecturer::latest()->paginate(10);
        return view('lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('lecturers.create', [
            'studyPrograms' => $this->studyPrograms
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:lecturers',
            'nip' => 'nullable|string|unique:lecturers',
            'nik' => 'nullable|string',
            'prodi' => 'nullable|string',
            'username' => 'nullable|string|unique:lecturers',
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        }

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('dosen', 'public');
        }

        Lecturer::create($validated);

        return redirect()->route('lecturers.index')
            ->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function show(Lecturer $lecturer)
    {
        return view('lecturers.show', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', [
            'lecturer' => $lecturer,
            'studyPrograms' => $this->studyPrograms
        ]);
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:lecturers,email,' . $lecturer->id,
            'nip' => 'nullable|string|unique:lecturers,nip,' . $lecturer->id,
            'nik' => 'nullable|string',
            'prodi' => 'nullable|string',
            'username' => 'nullable|string|unique:lecturers,username,' . $lecturer->id,
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('photo')) {
            if ($lecturer->photo) {
                Storage::disk('public')->delete($lecturer->photo);
            }
            $validated['photo'] = $request->file('photo')->store('dosen', 'public');
        }

        $lecturer->update($validated);

        return redirect()->route('lecturers.index')
            ->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer)
    {
        if ($lecturer->photo) {
            Storage::disk('public')->delete($lecturer->photo);
        }

        $lecturer->delete();

        return redirect()->route('lecturers.index')
            ->with('success', 'Dosen berhasil dihapus.');
    }
}
