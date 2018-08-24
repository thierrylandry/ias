<?php

namespace App\Http\Controllers\Car;

use App\Intervention;
use App\Metier\Behavior\Notifications;
use App\TypeIntervention;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReparationController extends Controller
{
    public function index(Request $request)
    {
        $debut = Carbon::now()->firstOfMonth();
        $fin = Carbon::now();

        if($request->input("debut") && $request->input("fin"))
        {
            $debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"));
            $fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"));
        }

        $interventions = Intervention::with("vehicule","typeIntervention")
            ->whereBetween("debut",[$debut->toDateString(), $fin->toDateTimeString()])
            ->orderBy("debut", "desc");

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

    public function nouvelle()
    {
        $vehicules = Vehicule::all();
        $types = TypeIntervention::all();
        return view("car.intervention.nouveau", compact("vehicules", "types"));
    }

    public function ajouter(Request $request)
    {
        $this->validate($request, $this->validateRules()[0], $this->validateRules()[1]);
        $intervention = new Intervention($request->except("_token", "vehicule"));
        $intervention->debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"))->toDateTimeString();
        $intervention->fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"))->toDateTimeString();
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
            "details" => "required"
            ],
	        [
	        	"cout.min" => "Le coût de la réparation ne peut pas être égale à 0"
	        ]
        ];
    }
}