<?php

namespace App\Http\Controllers\Car;

use App\Chauffeur;
use App\Genre;
use App\Metier\Processing\VehiculeManager;
use App\Metier\Security\Actions;
use App\Service;
use App\Statut;
use App\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    use VehiculeManager;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function index()
    {
	    $this->authorize(Actions::READ, collect([Service::DG, Service::ADMINISTRATION, Service::INFORMATIQUE, Service::GESTIONNAIRE_VL, Service::GESTIONNAIRE_PL]));

        $vehicules = Vehicule::with('genre')->where("status", Statut::VEHICULE_ACTIF);

        if(\request()->has("immatriculation") && !empty(\request()->query("immatriculation"))){
			$vehicules = $vehicules->where("immatriculation","like","%".\request()->query("immatriculation")."%");
        }

        $vehicules = $vehicules->paginate();

        return view('car.liste',compact('vehicules'));
    }

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function showNewFormView()
    {
	    $this->authorize(Actions::CREATE, collect([Service::DG, Service::ADMINISTRATION, Service::INFORMATIQUE, Service::GESTIONNAIRE_VL, Service::GESTIONNAIRE_PL]));

        $genres = Genre::all();

        $chauffeurs = Chauffeur::with('employe')->get();

        return view('car.nouveau', compact('genres', 'chauffeurs'));
    }
}
