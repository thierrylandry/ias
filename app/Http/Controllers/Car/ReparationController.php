<?php

namespace App\Http\Controllers\Car;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReparationController extends Controller
{
    public function index()
    {
        return view('car.reparations');
    }
}
