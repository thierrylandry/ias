<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
	const VL = "VL";
	const PL = "PL";
    public $timestamps = false;
    protected $table = 'vehicule';
    protected $guarded = [];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
