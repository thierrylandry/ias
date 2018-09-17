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
}
