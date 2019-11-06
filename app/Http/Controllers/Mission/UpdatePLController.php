<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Metier\Behavior\Notifications;
use App\Mission;
use App\MissionPL;
use App\Partenaire;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdatePLController extends Controller
{
	use Process;

	/**
	 * @param  $reference string
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function modifier($reference, Request $request)
	{
		try {
			$mission = $this->missionPLBuilder()
			                ->where("code", $reference)
			                ->firstOrFail();

			if(! empty($mission->piececomptable_id) || $mission->status != Statut::MISSION_COMMANDEE)
				return back()->withErrors("Impossible de modifier la mission #{$reference}. Celle-ci a déjà fait l'objet de facture ou à changé de statut");

		}catch (ModelNotFoundException $e){
			return back()->withErrors("La mission référencée est introuvable, vous l'avaez peut-être supprimée");
		}

		$vehicules = $this->listeVehiculeSelection($request);

		$chauffeurs = Chauffeur::with('employe')->get();

		$partenaires = Partenaire::where("isclient",true)
		                         ->orderBy("raisonsociale")
		                         ->get();

		return view("mission.pl.modifier", compact('vehicules','chauffeurs', "partenaires", "mission"));
	}

	public function update($reference, Request $request)
	{
		$this->validate($request, $this->validateMissionPLMaj());

		try {
			$mission = $this->missionPLBuilder()
			                ->where("code", $reference)
			                ->firstOrFail();

			if(! empty($mission->piececomptable_id) || $mission->status != Statut::MISSION_COMMANDEE){
				return back()->withErrors("Impossible de modifier la mission #{$reference}. Celle-ci a déjà fait l'objet de facture ou son statut à changé");
			}

			$this->maj($mission, $request);

		}catch (ModelNotFoundException $e){
			return back()->withErrors("La mission référencée est introuvable, vous l'avaez peut-être supprimée");
		}

		$notification = new Notifications();
		$notification->add(Notifications::SUCCESS,"Mission modifiée avec succès !");

		return redirect()->route("mission.liste-pl")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
	}

	/**
	 * @param MissionPL $mission
	 * @param Request $request
	 */
	private function maj(MissionPL $mission, Request $request)
	{
		$data = $request->except("_token");
		$data['datedebut'] = Carbon::createFromFormat("d/m/Y",$request->input("datedebut"))->toDateString();
		$mission->update($data);
	}

	public function updateAfterStart(Request $request, $reference){
		$this->validate($request, [
			"observation" => "present",
			"datedebut" => "required|date_format:d/m/Y",
			"datefin" => "required|date_format:d/m/Y",
		]);

		try {
			$mission = $this->missionPLBuilder()
			                ->where( "code", $reference)
			                ->firstOrFail();

			$mission->datedebut = Carbon::createFromFormat("d/m/Y",$request->input("datedebut"))->toDateString();

			if(!empty($request->input("fineffective"))){
				$mission->datefin = Carbon::createFromFormat("d/m/Y",$request->input("datefin"))->toDateString();
			}

			$mission->observation = $request->input("observation");

			$mission->saveOrFail();

		}catch (ModelNotFoundException $e){

		}

		$notification = new Notifications();
		$notification->add(Notifications::SUCCESS,"Mission modifiée avec succès !");
		return redirect()->back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
	}

}
