<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Metier\Behavior\Notifications;
use App\MissionPL;
use App\Partenaire;
use App\Statut;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlController extends Controller
{
	use Process;

	public function nouvellePL(Request $request)
	{
		$vehicules = $this->listeVehiculeSelection($request, Vehicule::PL);
		$chauffeurs = Chauffeur::with('employe')->get();

		$partenaires = Partenaire::where("isclient",true)
		                         ->orderBy("raisonsociale")
		                         ->get();
		return view('mission.pl.nouvelle',compact('vehicules','chauffeurs', "partenaires"));
	}

	public function ajouterPL(Request $request)
	{
		$this->validate($request, $this->validateMissionPL());
		$missionPL = $this->createPL($request);

		$notification = new Notifications();
		$notification->add(Notifications::SUCCESS,"Votre mission a été prise en compte. Voulez aller définir le bon de commande");

		$request->session()->put(Notifications::MISSION_OBJECT, $missionPL);

		return redirect()->route("mission.pl.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
	}

	private function createPL(Request $request)
	{
		$data = $request->except("_token");
		$this->generateCodeMission($data);

		$data["status"] = Statut::MISSION_COMMANDEE;
		$data["datedebut"] = Carbon::createFromFormat("d/m/Y",$request->input("datedebut"))->toDateString();

		return MissionPL::create($data);
	}
}
