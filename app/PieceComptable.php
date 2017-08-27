<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PieceComptable extends Model
{
    const PRO_FORMA = 1;
    const FACTURE = 2;
    const BON_LIVRAISON = 3;
    const TVA = 0.18;

    public $timestamps = false;
    protected $table = 'piececomptable';

    public function partenaire(){
        return $this->belongsTo(Partenaire::class);
    }

    public function lignes(){
        return $this->hasMany(LignePieceComptable::class, "piececomptable_id");
    }

    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class,'utilisateur_id');
    }
}
