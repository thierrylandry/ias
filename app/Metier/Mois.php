<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 08/10/2019
 * Time: 09:47
 */

namespace App\Metier;


class Mois {

	public static function getMonthName(int $value){
		return [
			1 => "Janvier",
			2 => "Février",
			3 => "Mars",
			4 => "Avril",
			5=> "Mai",
			6 => "Juin",
			7 => "Juillet",
			8 => "Août",
			9 => "Septembre",
			10 => "Octobre",
			11 => "Novembre",
			12 => "Décembre",
		][$value];
	}
}