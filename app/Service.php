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
	const DG = 'DIRG';
	const CHAUFFEUR = 'CHAUF';

    public $timestamps = false;
    protected $table = "service";

    public function employes(){
    	return $this->hasMany(Employe::class,"service_id");
    }
}
