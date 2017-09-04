<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 18/08/2017
 * Time: 21:13
 */

namespace App\Http\Controllers\Mission;


use App\Mission;
use App\Vehicule;
use Illuminate\Http\Request;

trait Process
{

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    private function missionBuilder()
    {
        return Mission::with(["chauffeur.employe", "vehicule", "clientPartenaire", "pieceComptable"]);
    }

    /**
     * @return array
     */
    public function validateMission()
    {
        return [
            "code" => "present",
            "destination" => "required",
            "debutprogramme" => "required",
            "finprogramme" => "required|date_format:d/m/Y",
            "perdiem" => "numeric",
            "chauffeur_id" => "required|numeric",
            "vehicule_id" => "required|numeric",
            "client" => "required|numeric",
        ];
    }

    /**
     * @return array
     */
    public function validateMissionMaj()
    {
        return [
            "code" => "required",
            "destination" => "required",
            "debuteffectif" => "required",
            "fineffective" => "required|date_format:d/m/Y",
            "perdiem" => "numeric",
            "chauffeur_id" => "required|numeric",
            "vehicule_id" => "required|numeric",
            "client" => "required|numeric",
        ];
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
}