<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLecturers = Lecturer::count();

        return view('dashboard', compact(
            'totalLecturers',
        ));
    }
}
