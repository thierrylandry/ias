<?php

namespace App\Http\Controllers\Mission;

use App\Mission;
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

        $missions = $this->missionBuilder($request)->get();

        return view("mission.liste",compact("missions"));
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
        return Mission::with(["chauffeur", "vehicule", "client"])
            ->whereBetween("debuteffectif",[$this->debut_periode->toDateString(), $this->fin_periode->toDateString()]);
    }
}
