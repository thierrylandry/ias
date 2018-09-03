<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compte extends Model
{
    use SoftDeletes;

    protected $table = 'compte';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function utilisateur(){
        return $this->belongsTo(Employe::class,'employe_id');
    }

    public function lignecompte(){
    	return $this->hasMany(LigneCompte::class,'compte_id','id');
    }
}