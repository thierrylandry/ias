<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneCompte extends Model
{
	use SoftDeletes;

    protected $table = 'lignecompte';
	protected $guarded = [];
	protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class,'employe_id',"employe_id");
    }

    public function compte(){
    	return $this->belongsTo(Compte::class);
    }
}