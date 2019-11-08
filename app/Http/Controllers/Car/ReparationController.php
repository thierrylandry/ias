<?php

namespace App\Http\Controllers\Car;

use App\Intervention;
use App\Metier\Behavior\Notifications;
use App\Metier\Security\Actions;
use App\Partenaire;
use App\Service;
use App\TypeIntervention;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class ReparationController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function index(Request $request)
    {
	    $this->authorize(Actions::READ, collect([Service::DG, Service::ADMINISTRATION, Service::INFORMATIQUE, Service::GESTIONNAIRE_PL, Service::GESTIONNAIRE_VL]));

        $debut = Carbon::now()->firstOfMonth();
        $fin = Carbon::now();

	    $interventions = Intervention::with("vehicule","typeIntervention","pieceFournisseur","partenaire");

        if($request->input("debut") && $request->input("fin"))
        {
            $debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"));
            $fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"));

	        $interventions = $interventions->whereBetween("debut",[$debut->toDateString(), $fin->toDateTimeString()]);
        }

	    $interventions = $interventions->orderBy("debut", "desc");

        if($request->input("vehicule") && $request->input("vehicule") != "#") {
            $interventions->where("vehicule_id", $request->input("vehicule"));
        }
        if($request->input("type") && $request->input("type") != "#") {
            $interventions->where("typeintervention_id", $request->input("type"));
        }

        $interventions = $interventions->paginate(30);

        $vehicules = Vehicule::all();
        $types = TypeIntervention::all();

        return view('car.intervention.reparations', compact("debut", "fin", "interventions", "vehicules", "types"));
    }

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function nouvelle()
    {
	    $this->authorize(Actions::CREATE, collect([Service::DG, Service::ADMINISTRATION, Service::INFORMATIQUE, Service::GESTIONNAIRE_VL, Service::GESTIONNAIRE_PL]));

        $vehicules = Vehicule::all();
        $types = TypeIntervention::all();
        $fournisseurs = Partenaire::where('isfournisseur','=',true)->orderBy('raisonsociale')->get();
        return view("car.intervention.nouveau", compact("vehicules", "types", "fournisseurs"));
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 * @throws \Throwable
	 */
    public function ajouter(Request $request)
    {
    	$this->authorize(Actions::CREATE, collect([Service::DG, Service::ADMINISTRATION, Service::INFORMATIQUE,
		    Service::GESTIONNAIRE_VL, Service::GESTIONNAIRE_PL]));

	    $this->validate($request, $this->validateRules()[0], $this->validateRules()[1]);

        $intervention = new Intervention($request->except("_token", "vehicule"));
        $intervention->debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"))->toDateTimeString();
        $intervention->fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"))->toDateTimeString();

        if($request->input("partenaire_id") == -1)
        {
        	$intervention->partenaire_id = null;
        }

        $intervention->saveOrFail();

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Nouvelle intervention enregistrée avec succès");

        return redirect()->route("reparation.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    private function validateRules()
    {
        return [
        	[
	            "debut" => "required|date_format:d/m/Y",
	            "fin" => "required|date_format:d/m/Y",
	            "vehicule_id" => "required|exists:vehicule,id",
	            "typeintervention_id" => "required|exists:typeintervention,id",
	            "cout" => "required|integer|min:1",
	            "details" => "required",
		        "partenaire_id" => "required"
            ],
	        [
	        	"cout.min" => "Le coût de la réparation ne peut pas être égale à 0"
	        ]
        ];
    }
}