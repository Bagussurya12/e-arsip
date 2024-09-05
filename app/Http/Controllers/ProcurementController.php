<?php

namespace App\Http\Controllers;
use App\Models\Procurement;

use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    //
    public function index()
    {
        $procurement = Procurement::orderBy('id', 'DESC')->get();

        return inertia('Procurement/Index', [
            'procurement' => $procurement,
        ]);
    }
}
