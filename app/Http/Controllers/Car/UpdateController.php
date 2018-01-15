<?php

namespace App\Http\Controllers\Car;

use App\Genre;
use App\Metier\Processing\VehiculeManager;
use App\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    use VehiculeManager;

    public function modifier(string $immatriculation)
    {
        $vehicule =  Vehicule::with("genre")
            ->where("immatriculation",$immatriculation)
        ->firstOrFail();

        if($vehicule != null)
        {
            $genres = Genre::all();
            return view("car.modification", compact("genres","vehicule"));
        }

        return back()->withErrors("Véhicule introuvable");
    }
}
