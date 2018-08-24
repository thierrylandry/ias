<?php

namespace App\Http\Controllers\Car;

use App\Intervention;
use App\Mission;
use App\Vehicule;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FicheController extends Controller
{
    public function details($immatriculation)
    {
        $vehicule = Vehicule::with("genre")
            ->where("immatriculation", $immatriculation)
            ->first();

        $collection = $this->getInterventions($vehicule);

        foreach ($this->getMission($vehicule) as $item)
        {
           $collection->add($item);
        }

	    $collection = $collection->each(function ($item, $key) {
		    $item->date_ = (new Carbon($item->date_))->timestamp;
	    })->sortBy("date_");

        return view("car.fiche", compact("vehicule", "collection"));
    }

    /**
     * @param Vehicule $vehicule
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getInterventions(Vehicule $vehicule)
    {
        return Intervention::with("typeIntervention")
            ->where("vehicule_id", $vehicule->id)
            ->select("intervention.*","debut as date_")
            ->get();
    }

    /**
     * @param Vehicule $vehicule
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getMission(Vehicule $vehicule)
    {
        return Mission::with("clientPartenaire")
            ->where("vehicule_id", $vehicule->id)
            ->select("mission.*", "debuteffectif as date_")
            ->get();
    }
}
