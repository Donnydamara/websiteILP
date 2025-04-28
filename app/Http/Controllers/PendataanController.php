<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendataanController extends Controller
{
    public function index()
    {
        return view('pendataan.index'); // Pastikan view ini ada
    }
}
