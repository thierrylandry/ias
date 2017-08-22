<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    public $timestamps = false;
    protected $table = "famille";
    protected $guarded = [];
}
