<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendrierController extends Controller
{
    public function index()
    {
        return view('calendrier.index');
    }
}
