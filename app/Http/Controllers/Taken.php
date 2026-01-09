<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Taken extends Controller
{
    public function index() {
        return view('takenMaken.index');
    }
}
