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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

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

    private function save(Request $request)
    {
        $vehicule = new Vehicule($request->except('_token'));

        $vehicule->visite = Carbon::createFromFormat('d/m/Y',$vehicule->visite)->toDateString();
        $vehicule->assurance = Carbon::createFromFormat('d/m/Y',$vehicule->assurance)->toDateString();

        $vehicule->save();
    }

    /**
     * @return array
     */
    protected function validateRules($withID = false)
    {
        $rules = [
            'immatriculation' =>'required|regex:/([0-9]{1,4})([A-Z]{2})([0-3]{2})/',
            'genre_id' => 'required|numeric',
            'cartegrise' => 'required',
            'marque' => 'required',
            'typecommercial' => 'present',
            'couleur' => 'required',
            'energie' => 'required',
            'nbreplace' => 'required|numeric',
            'puissancefiscale' => 'present',
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