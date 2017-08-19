<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Metier\Behavior\Notifications;
use App\Mission;
use App\Partenaire;
use App\Vehicule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function ajouter(Request $request)
    {
        $this->validate($request, $this->validateMission());

        $mission =  $this->create($request);

        $this->makeCommande($mission);
    }

    public function makeCommande(Mission $mission)
    {
        $noitification = new Notifications();
        $noitification->add(Notifications::SUCCESS,"Votre mission a été prise en compte. Voulez aller définir le bon de commande");
        //TODO : Faire la route pour le bon de commande issu de la mission et éditer son PDF
    }

    /**
     * @param Request $request
     * @return Mission
     */
    private function create(Request $request)
    {
        return Mission::create($request->except("_token"));
    }
}
