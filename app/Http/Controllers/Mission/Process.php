<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 18/08/2017
 * Time: 21:13
 */

namespace App\Http\Controllers\Mission;


use App\Metier\Behavior\Notifications;
use App\Mission;
use App\Vehicule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function changeStatus(string $reference, int $statut, Request $request)
    {
        $sessionToken = $request->session()->token();
        $token = $request->input('_token');
        if (! is_string($sessionToken) || ! is_string($token) || !hash_equals($sessionToken, $token) ) {
            return back()->withErrors('La page a expiré, veuillez recommencer SVP !');
        }

        try {
            $mission = $this->missionBuilder()
                ->where("code", $reference)
                ->firstOrFail();

            $mission->status = $statut;
            $mission->save();

        }catch(ModelNotFoundException $e){
            return back()->withErrors('La mission est introuvable !');
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Statut de la mission modifiée avec succès !");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }
}