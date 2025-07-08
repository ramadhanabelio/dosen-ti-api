<?php

namespace App\Http\Controllers\API;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    public function getProdiList()
    {
        $prodis = Lecturer::select('prodi')
            ->whereNotNull('prodi')
            ->distinct()
            ->pluck('prodi');

        return response()->json([
            'status' => 'success',
            'data' => $prodis
        ]);
    }

    public function getLecturersByProdi($prodi)
    {
        $lecturers = Lecturer::where('prodi', $prodi)->get();

        return response()->json([
            'status' => 'success',
            'data' => $lecturers
        ]);
    }

    public function getResearchByLecturerId($id)
    {
        $lecturer = Lecturer::with('researches')->find($id);

        if (!$lecturer) {
            return response()->json([
                'message' => 'Dosen tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'message' => 'Daftar penelitian dosen.',
            'data' => $lecturer->researches
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $lecturer = Lecturer::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        if (!$lecturer) {
            return response()->json([
                'message' => 'Email atau username tidak ditemukan.',
            ], 404);
        }

        if (!Hash::check($request->password, $lecturer->password)) {
            return response()->json([
                'message' => 'Password yang Anda masukkan salah.',
            ], 401);
        }

        $token = $lecturer->createToken('lecturer_token')->plainTextToken;

        return response()->json([
            'message' => 'Berhasil login.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'lecturer' => [
                'id' => $lecturer->id,
                'name' => $lecturer->name,
                'email' => $lecturer->email,
                'nip' => $lecturer->nip,
                'nik' => $lecturer->nik,
                'prodi' => $lecturer->prodi,
                'username' => $lecturer->username,
                'photo' => $lecturer->photo,
            ],
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'lecturer' => $request->user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $lecturer = auth()->user();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:50',
            'prodi' => ['nullable', Rule::in([
                'Teknik Informatika',
                'Rekayasa Perangkat Lunak',
                'Keamanan Sistem Informasi',
            ])],
            'username' => [
                'sometimes',
                'string',
                Rule::unique('lecturers')->ignore($lecturer->id),
            ],
            'email' => [
                'sometimes',
                'email',
                Rule::unique('lecturers')->ignore($lecturer->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|string',
        ]);

        $lecturer->update($request->except(['password']));

        if ($request->filled('password')) {
            $lecturer->password = bcrypt($request->password);
            $lecturer->save();
        }

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
            'lecturer' => $lecturer
        ]);
    }

    public function getMyResearch(Request $request)
    {
        $lecturer = auth()->user();

        if (!$lecturer) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $researches = $lecturer->researches;

        return response()->json([
            'message' => 'Daftar penelitian',
            'data' => $researches
        ]);
    }

    public function addResearch(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'abstract' => 'nullable|string',
            'field' => 'nullable|string',
            'year' => 'nullable|digits:4|integer',
            'document' => 'nullable|string',
        ]);

        $research = auth()->user()->researches()->create($request->all());

        return response()->json([
            'message' => 'Penelitian berhasil ditambahkan.',
            'data' => $research
        ]);
    }

    public function updateResearch(Request $request, $id)
    {
        $lecturer = auth()->user();
        $research = $lecturer->researches()->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string',
            'abstract' => 'nullable|string',
            'field' => 'sometimes|string',
            'year' => 'sometimes|digits:4|integer',
            'document' => 'nullable|string',
        ]);

        $research->update($request->all());

        return response()->json([
            'message' => 'Penelitian berhasil diperbarui.',
            'data' => $research
        ]);
    }

    public function deleteResearch($id)
    {
        $lecturer = auth()->user();
        $research = $lecturer->researches()->findOrFail($id);

        $research->delete();

        return response()->json([
            'message' => 'Penelitian berhasil dihapus.'
        ]);
    }
}
