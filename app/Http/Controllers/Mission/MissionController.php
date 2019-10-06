<?php

namespace App\Http\Controllers\Mission;

use App\Chauffeur;
use App\Mail\MissionReminder;
use App\Mission;
use App\Service;
use App\Statut;
use App\Utilisateur;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MissionController extends Controller
{
    use Process;

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

        if($this->debut_periode && $this->fin_periode){
	        $debut = $this->debut_periode->format("d/m/Y");
	        $fin = $this->fin_periode->format("d/m/Y");
        }else{
        	$debut = Carbon::now()->firstOfMonth()->format("d/m/Y");
        	$fin = Carbon::now()->format("d/m/Y");
        }


        $missions = $this->missionBuilder();
        if($this->debut_periode && $this->fin_periode){
	        $missions = $missions->whereBetween("debuteffectif",[$this->debut_periode->toDateString(), $this->fin_periode->toDateString()]);
        }


        $missions = $missions->paginate(30);

        $chauffeurs = Chauffeur::with("employe")->get();

        $status = collect([
           Statut::MISSION_COMMANDEE => Statut::getStatut(Statut::MISSION_COMMANDEE),
           Statut::MISSION_EN_COURS  => Statut::getStatut(Statut::MISSION_EN_COURS),
           Statut::MISSION_TERMINEE  => Statut::getStatut(Statut::MISSION_TERMINEE),
           Statut::MISSION_ANNULEE   => Statut::getStatut(Statut::MISSION_ANNULEE),
        ]);

        return view("mission.liste",compact("missions", "debut", "fin", "chauffeurs", "status"));
    }

    private function getPeriode(Request $request)
    {
        $debut = null;
        $fin = null;

        if($request->has(["debut","fin"]))
        {
            $debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"));
            $fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"));
        }

        $this->debut_periode = $debut;
        $this->fin_periode = $fin;
    }

    public function details($reference)
    {
        $mission = $this->missionBuilder()
            ->where("code",$reference)
            ->firstOrFail();

        return view("mission.details",compact("mission"));
    }

    public function reminder()
    {
    	$utilisateurs = Utilisateur::with('employe.service')
                      ->join('employe','employe.id','=', 'utilisateur.employe_id')
                      ->join('service','service.id','=', 'employe.service_id')
                      ->whereIn('service.code',[Service::GESTIONNAIRE_PL, Service::GESTIONNAIRE_VL, Service::ADMINISTRATION])
                      ->get();

	    $senders = $this->sortEmail($utilisateurs);

	    $missions = Mission::with('chauffeur.employe','vehicule','clientPartenaire')
	                       ->whereRaw('datediff(debuteffectif, sysdate()) > 0')
	                       ->whereRaw('datediff(debuteffectif, sysdate()) <= '.env('APP_MISSION_REMINDER',5))
		                   ->get();

	    //return view('mail.mission', compact("missions"));

	    try{
	    	if($missions->count() <= 1 )
		    {
			    Mail::to($senders->get('to'))
			        ->cc($senders->get('cc'))
			        ->send(new MissionReminder($missions ));
		    }
		}catch (\Exception $e){
			Log::error($e->getMessage()."\r\n".$e->getTraceAsString());
	    }
    }

    private function sortEmail(Collection $users)
    {
		$collection = new Collection();

	    $to = [];
	    $cc = [];
		foreach ($users as $user)
		{
			if( in_array($user->employe->service->code, [Service::GESTIONNAIRE_VL, Service::GESTIONNAIRE_PL]) )
			{
				$to[] = ['name' => $user->nom.' '.$user->prenoms, 'email' => $user->login];
			}else{
				$cc[] = ['name' => $user->nom.' '.$user->prenoms, 'email' => $user->login];
			}
		}

	    $collection->put('to', $to);
	    $collection->put('cc', $cc);

	    return $collection;
    }
}
