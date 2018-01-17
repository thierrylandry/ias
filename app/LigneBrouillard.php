<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneBrouillard extends Model
{
    protected $table = 'lignebrouillard';
    public $timestamps = false;

    public function employe(){
        return $this->belongsTo(Utilisateur::class,'employe_id');
    }
}
