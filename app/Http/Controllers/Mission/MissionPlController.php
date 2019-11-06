<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionPlController extends Controller
{

	use Process;

	/**
	 * @var Carbon $debut_periode
	 */
	private $debut_periode;

	/**
	 * @var Carbon $fin_periode
	 */
	private $fin_periode;

	public function listePL(Request $request)
	{
		$this->getPeriode($request);

		if($this->debut_periode && $this->fin_periode){
			$debut = $this->debut_periode->format("d/m/Y");
			$fin = $this->fin_periode->format("d/m/Y");
		}else{
			$debut = Carbon::now()->firstOfMonth()->format("d/m/Y");
			$fin = Carbon::now()->format("d/m/Y");
		}


		$missions = $this->missionPLBuilder();
		if($this->debut_periode && $this->fin_periode){
			$missions = $missions->whereBetween("datedebut",[$this->debut_periode->toDateString(), $this->fin_periode->toDateString()]);
		}


		$missions = $missions->orderBy("datedebut","desc")->paginate(30);

		$chauffeurs = Chauffeur::with("employe")->get();

		$status = collect([
			Statut::MISSION_COMMANDEE => Statut::getStatut(Statut::MISSION_COMMANDEE),
			Statut::MISSION_EN_COURS  => Statut::getStatut(Statut::MISSION_EN_COURS),
			Statut::MISSION_TERMINEE  => Statut::getStatut(Statut::MISSION_TERMINEE),
			Statut::MISSION_ANNULEE   => Statut::getStatut(Statut::MISSION_ANNULEE),
		]);

		return view("mission.pl.liste",compact("missions", "debut", "fin", "chauffeurs", "status"));
	}

	public function details($reference){
		$mission = $this->missionPLBuilder()
		                ->where("code",$reference)
		                ->firstOrFail();

		return view("mission.pl.details",compact("mission"));
	}
}
