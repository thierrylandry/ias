<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 27/07/2017
 * Time: 09:38
 */

namespace App\Metier\Processing;


use App\Metier\Behavior\Notifications;
use App\Vehicule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

trait VehiculeManager
{
    public function ajouter(Request $request)
    {
        $this->validate($request,$this->validateRules(false));

        $this->save($request);

        $notification = new Notifications();
        $notification->add($notification::SUCCESS,Lang::get('message.vehicule.ajout',['immatriculation' => $request->input('immatriculation')]));

        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION,$notification);
    }

    private function save(Request $request, Vehicule $vehicule = null)
    {
        if($vehicule === null){
            $vehicule = new Vehicule($request->except('_token'));
        }

        $vehicule->visite    = Carbon::createFromFormat('d/m/Y',$request->input("visite")   )->toDateString();
        $vehicule->assurance = Carbon::createFromFormat('d/m/Y',$request->input("assurance"))->toDateString();
        $vehicule->dateachat = Carbon::createFromFormat('d/m/Y',$request->input("dateachat"))->toDateString();

        $vehicule->save();
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->validateRules(true));

        try{
            $vehicule = Vehicule::find($request->input('id'));

            $vehicule->fill($request->except("visite", "assurance", "dateachat"));

            $this->save($request, $vehicule);

            $notification = new Notifications();
            $notification->add($notification::SUCCESS,Lang::get('message.vehicule.modifier',['immatriculation' => $request->input('immatriculation')]));

            return back()->with(Notifications::NOTIFICATION_KEYS_SESSION,$notification);
        }catch (ModelNotFoundException $e){
            Log::error($e->getMessage()."\r\n".$e->getTraceAsString());
            return back()->withErrors("Véhicule non trouvé");
        }
    }

    /**
     * @return array
     */
    protected function validateRules($withID = false)
    {
        $rules = [
            'immatriculation' =>'required|regex:/([0-9]{1,4})([A-Z]{2})([0-5]{2})/',
            'genre_id' => 'required|numeric|exists:genre,id',
            'cartegrise' => 'required',
            'marque' => 'required',
            'typecommercial' => 'present',
            'couleur' => 'required',
            'energie' => 'required',
            'nbreplace' => 'required|numeric',
            'puissancefiscale' => 'present',
            'dateachat' => "required|date_format:d/m/Y",
            'coutachat' => "required|numeric",
            'chauffeur_id' => "required|exists:chauffeur,employe_id",
        ];

        if($withID){
            $rules['id'] = 'required|numeric';
        }
        return $rules;
    }

    private function test()
    {
        //dd($request->input());
        //$this->validate($request,$this->validateRules(false));
        //return back()->withInput()->withErrors('No body');


        $n = new Notifications();
        $n->add($n::INFO,'success');

        return back()->withInput()->with(Notifications::NOTIFICATION_KEYS_SESSION,$n);
    }
}