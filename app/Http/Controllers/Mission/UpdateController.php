<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Metier\Behavior\Notifications;
use App\Mission;
use App\Partenaire;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
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
            $mission = $this->missionBuilder()
                ->where("code", $reference)
                ->firstOrFail();

            if(! empty($mission->piececomptable_id) || $mission->status != Statut::MISSION_COMMANDEE)
                return back()->withErrors("Impossible de modifier la mission #{$reference}. Celle-ci a déjà fait l'objet de facture ou son statut à changé.");

        }catch (ModelNotFoundException $e){
            return back()->withErrors("La mission référencée est introuvable, vous l'avaez peut-être supprimée");
        }

        $vehicules = $this->listeVehiculeSelection($request);

        $chauffeurs = Chauffeur::with('employe')->get();

        $partenaires = Partenaire::where("isclient",true)
            ->orderBy("raisonsociale")
            ->get();

        return view("mission.modifier", compact('vehicules','chauffeurs', "partenaires", "mission"));
    }

    public function update($reference, Request $request)
    {
        $this->validate($request, $this->validateMissionMaj());

        try {
            $mission = $this->missionBuilder()
                ->where("code", $reference)
                ->firstOrFail();

            if(! empty($mission->piececomptable_id) || $mission->status != Statut::MISSION_COMMANDEE)
                return back()->withErrors("Impossible de modifier la mission #{$reference}. Celle-ci a déjà fait l'objet de facture ou son statut à changé.");

            $this->maj($mission, $request);

        }catch (ModelNotFoundException $e){
            return back()->withErrors("La mission référencée est introuvable, vous l'avaez peut-être supprimée");
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Mission modifiée avec succès !");

        return redirect()->route("mission.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    /**
     * @param Mission $mission
     * @param Request $request
     */
    private function maj(Mission $mission, Request $request)
    {
        $data = $request->except("_token");
        $data["debuteffectif"] = Carbon::createFromFormat("d/m/Y",$request->input("debuteffectif"))->toDateString();
        $data["fineffective"] = Carbon::createFromFormat("d/m/Y",$request->input("fineffective"))->toDateString();

        $mission->update($data);
    }
}
