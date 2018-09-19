<?php

namespace App\Http\Controllers\RH;

use App\Bulletin;
use App\Metier\Security\Actions;
use App\Salaire;
use App\Service;
use Illuminate\Database\QueryException;
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

	    $salaires = Salaire::orderBy('annee','desc')
		            ->orderBy('mois','desc')
		            ->paginate(10);
    	return view('rh.salaire', compact("annees", "months", "salaires"));
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

	    try{
		    $salaire->saveOrFail();
	    }catch (QueryException $e){
	    	return $this->handleSalaireError($request);
	    }

	    $annee =$request->input('annee');
	    $mois = $request->input('mois');

	    return redirect()->route('rh.paie', compact("annee", "mois") );
    }

	private function handleSalaireError(Request $request)
	{
		$salaire = Salaire::where('mois', '=', $request->input('mois'))
		                  ->where('annee', '=', $request->input('annee'))
		                  ->firstOrFail();

		$pageId = $this->getLastEmployePage($request->input('annee'), $request->input('mois'));

		return redirect()->route('rh.salaire', ['state' => $salaire->statut, "target"=>$pageId])
			->withInput()
			->withErrors('Les salaires du mois de '.self::getMonthsById($request->input('mois')).' '
			             .$request->input('annee').' ont déjà été '.strtolower(Salaire::getStateToString($salaire->statut)).'s.');
	}

	private function getLastEmployePage(int $annee, int $mois)
	{
		return Bulletin::where('annee','=', $annee)
		                  ->where('mois','=', $mois)
		                  ->count() + 1;
	}

	/**
	 * @param int $annee
	 * @param int $mois
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function reset(int $annee, int $mois)
	{
		Bulletin::where('annee','=',$annee)
			->where('mois','=',$mois)
			->delete();

		return redirect()->route('rh.paie', compact("annee", "mois") );
	}
}