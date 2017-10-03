<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    public $timestamps = false;
    protected $table = "versement";
    protected $guarded = [];

    public function mission(){
        return $this->belongsTo(Mission::class);
    }

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class,"employe_id", "employe_id");
    }

    public function moyenreglement(){
        return $this->belongsTo(MoyenReglement::class,"moyenreglement_id");
    }
}