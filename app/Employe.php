<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = "employe";
    protected $guarded = [];

    public $timestamps = false;

    public function utilisateur(){
        return $this->hasOne(Utilisateur::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
