<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 11/09/2018
 * Time: 15:39
 */

namespace App\Http\Controllers\RH;


use App\Employe;
use App\Http\Controllers\Controller;
use App\Metier\Security\Actions;
use App\Mission;
use App\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class PaieController extends Controller
{
	/**
	 * PaieController constructor.
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function fichePaie(Request $request, string $matricule)
	{
		$this->authorize(Actions::CREATE, collect([Service::ADMINISTRATION, Service::COMPTABILITE, Service::INFORMATIQUE]));

		$employe = Employe::where('matricule', '=', $matricule)->firstOrFail();

		$missions = $this->getMissionLines($employe, Carbon::now());

		$annees = $this->getYears();
		$months = $this->getMonths();

		//dd($missions);

		return view("rh.fiche", compact("employe", "missions", "annees", "months"));
	}

	private function getMissionLines(Employe $employe, Carbon $date)
	{
		return Mission::with('vehicule')
			->whereRaw("month(debuteffectif) = {$date->month} or month(fineffective) = {$date->month} AND chauffeur_id = {$employe->id}")
			->select( DB::raw("CASE WHEN month(debuteffectif) = month(fineffective) then datediff(fineffective, debuteffectif)
WHEN  month(debuteffectif) < month(fineffective) && month(debuteffectif) = {$date->month} THEN datediff('{$date->endOfMonth()->toDateString()}', debuteffectif)
WHEN    month(debuteffectif) < month(fineffective) && month(debuteffectif) < {$date->month} THEN datediff(fineffective, '{$date->firstOfMonth()->toDateString()}')
END + 1 as nbre_jours ,debuteffectif , fineffective, code, destination, perdiem"))
			->get();
	}

	private function getYears()
	{
		$years = [];
		for ($i = 2017; $i <= Carbon::now()->year; $i++){
			$years[] = $i;
		}
		return $years;
	}

	private function getMonths()
	{
		return [
			(object)[ "id" =>"1", "libelle" => "Janvier" ],
			(object)[ "id" =>"2", "libelle" => "Février" ],
			(object)[ "id" =>"3", "libelle" => "Mars" ],
			(object)[ "id" =>"4", "libelle" => "Avril" ],
			(object)[ "id" =>"5", "libelle" => "Mai" ],
			(object)[ "id" =>"6", "libelle" => "Juin" ],
			(object)[ "id" =>"7", "libelle" => "Juillet" ],
			(object)[ "id" =>"8", "libelle" => "Août" ],
			(object)[ "id" =>"9", "libelle" => "Septembre" ],
			(object)[ "id" =>"10", "libelle" => "Octobre" ],
			(object)[ "id" =>"11", "libelle" => "Novembre" ],
			(object)[ "id" =>"12", "libelle" => "Décembre" ],
		];
	}
}