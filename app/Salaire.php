<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
	public $timestamps = false;
	protected $table = "salaire";
	protected $primaryKey = ["mois", "annee"];
}
