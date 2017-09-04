<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Mission;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    /**
     * @var Carbon $debut_periode
     */
    private $debut_periode;

    /**
     * @var Carbon $fin_periode
     */
    private $fin_periode;

    public function liste(Request $request)
    {
        $this->getPeriode($request);

        $debut = $this->debut_periode->format("d/m/Y");
        $fin = $this->fin_periode->format("d/m/Y");

        $missions = $this->missionBuilder($request)->paginate(30);

        $chauffeurs = Chauffeur::with("employe")->get();
        $status = collect([
           Statut::MISSION_COMMANDEE => Statut::getStatut(Statut::MISSION_COMMANDEE),
           Statut::MISSION_EN_COURS => Statut::getStatut(Statut::MISSION_EN_COURS),
           Statut::MISSION_TERMINEE => Statut::getStatut(Statut::MISSION_TERMINEE),
           Statut::MISSION_ANNULEE => Statut::getStatut(Statut::MISSION_ANNULEE),
        ]);

        //dd($missions);

        return view("mission.liste",compact("missions", "debut", "fin", "chauffeurs", "status"));
    }

    private function getPeriode(Request $request)
    {
        $debut = Carbon::now()->firstOfMonth(); //début du mois
        $fin = Carbon::now();

        if($request->has(["debut","fin"]))
        {
            $debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"));
            $fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"));
        }

        $this->debut_periode = $debut;
        $this->fin_periode = $fin;
    }



    private function missionBuilder(Request $request)
    {
        return Mission::with(["chauffeur.employe", "vehicule", "clientPartenaire", "pieceComptable"])
            ->whereBetween("debuteffectif",[$this->debut_periode->toDateString(), $this->fin_periode->toDateString()]);
    }

    public function details()
    {
        return view("mission.details");
    }
}
