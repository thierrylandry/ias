<?php

namespace App\Http\Controllers\RH;

use App\Metier\Security\Actions;
use App\Salaire;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaireController extends Controller
{
	use Tools;

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function demarrage()
    {
    	$this->authorize(Actions::CREATE, collect([Service::INFORMATIQUE, Service::ADMINISTRATION, Service::COMPTABILITE]));
	    $annees = $this->getYears();
	    $months = $this->getMonths();

    	return view('rh.salaire', compact("annees", "months"));
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 * @throws \Throwable
	 */
    public function start(Request $request)
    {
	    $this->authorize(Actions::CREATE, collect([Service::INFORMATIQUE, Service::ADMINISTRATION, Service::COMPTABILITE]));

	    $salaire = new Salaire();
	    $salaire->mois = $request->input('mois');
	    $salaire->annee = $request->input('annee');
	    $salaire->statut = Salaire::ETAT_DEMARRE;
	    $salaire->saveOrFail();

	    $annee = $salaire->annee;
	    $mois = $salaire->mois;

	    return redirect()->route('rh.paie', compact("annee", "mois") );
    }
}
