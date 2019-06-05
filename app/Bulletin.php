<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
	const BASE = 'base';
	const TAUX = 'taux';
	const LIBELLE = 'libelle';

    public $timestamps = false;
    protected $table = "bulletin";
    protected $primaryKey = "mois";

    protected $casts = [
    	"lignes" => "array"
    ];

	public function employe(){
		return $this->belongsTo(Employe::class,"employe_id");
	}

	public function salaire(){
		return $this->belongsTo(Salaire::class, "mois");
	}
}
