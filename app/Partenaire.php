<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    const CLIENT = 'client';
    const FOURNISSEUR = 'fournisseur';

    protected $table = 'partenaire';
    public $timestamps = false;
}
