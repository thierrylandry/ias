<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 04/09/2018
 * Time: 09:13
 */

namespace App\Http\Controllers\Money;


use App\Compte;
use App\Service;
use App\Utilisateur;
use Illuminate\Support\Facades\Auth;

trait Tresorerie
{
	/**
	 * @param int $value
	 *
	 * @return bool
	 */
	private function checkExistUser(int $value)
	{
		if(is_numeric($value) && $value != -1 ){
			try{
				Utilisateur::findOrFail($value);
				return true;
			}catch (\Exception $e){
				return false;
			}
		}
		return false;
	}

	private function getListCompteByUser()
	{
		$comptes = Compte::with('utilisateur');

		if(!in_array(Auth::user()->employe->service->code, [Service::ADMINISTRATION, Service::INFORMATIQUE])){
			$comptes = $comptes->where('employe_id','=',Auth::id());
		}

		return $comptes->with(['lignecompte' => function ($query){
								$query->orderBy('dateaction','desc');
								//Peut y avoir des problèmes de performances
						}])->get();
	}
}