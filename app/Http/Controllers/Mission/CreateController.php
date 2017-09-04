<?php

namespace App\Http\Controllers\Mission;

use App\Application;
use App\Chauffeur;
use App\Metier\Behavior\Notifications;
use App\Metier\Finance\InvoiceFrom;
use App\Mission;
use App\Partenaire;
use App\Statut;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CreateController extends Controller
{
    use Process;

    public function nouvelle(Request $request)
    {
        $vehicules = $this->listeVehiculeSelection($request);

        $chaufffeurs = Chauffeur::with('employe')->get();

        $partenaires = Partenaire::where("isclient",true)
            ->orderBy("raisonsociale")
            ->get();

        return view('mission.nouvelle',compact('vehicules','chaufffeurs', "partenaires"));
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ajouter(Request $request)
    {
        $this->validate($request, $this->validateMission());

        $mission =  $this->create($request);

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Votre mission a été prise en compte. Voulez aller définir le bon de commande");

        $request->session()->put(Notifications::MISSION_OBJECT, $mission);

        return redirect()->route("facturation.proforma.nouvelle", ["from" => InvoiceFrom::mission()])->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    /**
     * @param Request $request
     * @return Mission
     */
    private function create(Request $request)
    {
        $data = $request->except("_token");

        if(! array_key_exists("code",$data) || $data["code"] == null)
        {
            $data["code"] = Application::getNumeroMission(true);
        }

        $data["status"] = Statut::MISSION_COMMANDEE;

        $data["debutprogramme"] = Carbon::createFromFormat("d/m/Y",$request->input("debutprogramme"))->toDateString();
        $data["debuteffectif"] = $data["debutprogramme"];

        $data["finprogramme"] = Carbon::createFromFormat("d/m/Y",$request->input("finprogramme"))->toDateString();
        $data["fineffective"] = $data["finprogramme"];

        return Mission::create($data);
    }
}
