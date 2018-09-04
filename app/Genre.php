<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	const VEHICULE_LEGER = 'VL';
	const POIDS_LOURD = 'PL';

    public $timestamps = false;
    protected $table = 'genre';
}
