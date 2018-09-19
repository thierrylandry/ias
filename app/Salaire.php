<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
	const ETAT_DEMARRE = 1;
	const ETAT_VALIDE = 2;
	const ETAT_CLOTURE = 3;

	public $timestamps = false;
	protected $table = "salaire";
	protected $primaryKey = "mois";

	public static function getStateToString(int $state)
	{
		switch ($state){
			case self::ETAT_DEMARRE : return "Démarré";
			case self::ETAT_VALIDE : return "Validé";
			case self::ETAT_CLOTURE : return "Clôturé";
		}
		return null;
	}
}
