<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Vehicule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    //

    public function ajouter(Request $request)
    {
        $vehicules = $this->listeVehiculeSelection($request);
        $chaufffeurs = Chauffeur::with('employe')->get();

        return view('mission.nouvelle',compact('vehicules','chaufffeurs'));
    }

    private function listeVehiculeSelection(Request $request)
    {
        if($request->has('vehicule'))
        {
            return Vehicule::where('immatriculation',$request->input('vehicule'))->get();
        }else{
            return Vehicule::all();
        }
    }
}
