<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    public $timestamps = false;
    protected $table = "chauffeur";
    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class);
    }
}
