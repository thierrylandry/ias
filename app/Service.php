<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	const INFORMATIQUE = 'INFO';
	const COMPTABILITE = 'COMPT';
	const LOGISTIQUE = 'LOGIS';
	const ADMINISTRATION = 'ADMIN';
	const GESTIONNAIRE_PL = 'GESPL';
	const GESTIONNAIRE_VL = 'GESVL';

    public $timestamps = false;
    protected $table = "service";
}
