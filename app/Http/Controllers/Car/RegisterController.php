<?php

namespace App\Http\Controllers\Car;

use App\Genre;
use App\Metier\Processing\VehiculeManager;
use App\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    use VehiculeManager;

    public function index()
    {
        $vehicules = Vehicule::with('genre')->get();

        return view('car.liste',compact('vehicules'));
    }

    public function showNewFormView()
    {
        $genres = Genre::all();

        return view('car.nouveau', compact('genres'));
    }
}
