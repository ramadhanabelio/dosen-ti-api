<?php

namespace App\Http\Controllers\API;

use App\Models\Lecturer;
use App\Http\Controllers\Controller;

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
}
