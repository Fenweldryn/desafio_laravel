<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('id', 'desc')->get();
        return view('dashboard', compact('movies'));
    }
}
