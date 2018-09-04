<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 04/09/2018
 * Time: 10:05
 */

namespace App\Metier\Behavior;


use Illuminate\Support\Facades\Auth;

trait Gates {

	/**
	 * @param string $code
	 *
	 * @return bool
	 */
	public function authorize(string $code)
	{
		if(Auth::user()->employe->service->code == $code){
			return true;
		}
		return false;
	}

	public function authorizes(string ...$codes)
	{
		foreach ($codes as $code)
		{
			if($this->authorize($code)){
				return true;
			}
		}
		return false;
	}
}