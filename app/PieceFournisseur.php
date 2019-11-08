<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PieceFournisseur extends Model
{
    protected $table = 'piecefournisseur';
    protected $guarded = [];
    public $timestamps = false;

    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class,'utilisateur_id');
    }

    public function moyenPaiement(){
        return $this->belongsTo(MoyenReglement::class,'moyenpaiement_id');
    }

    public function partenaire(){
        return $this->belongsTo(Partenaire::class,'partenaire_id');
    }

	public function lignes(){
		return $this->hasMany(LignePieceFournisseur::class, "piecefournisseur_id");
	}
}
