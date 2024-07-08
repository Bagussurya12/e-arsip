<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataTerusanController extends Controller
{
    public function index()
    {
        return inertia('Terusan/Index');
    }
}
