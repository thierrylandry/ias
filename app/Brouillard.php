<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brouillard extends Model
{
    use SoftDeletes;

    protected $table = 'lignebrouillard';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function utilisateur(){
        return $this->belongsTo(Employe::class,'employe_id');
    }
}
