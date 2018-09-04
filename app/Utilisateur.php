<?php

namespace App;

use App\Metier\Behavior\Gates;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'utilisateur';
    protected $primaryKey = 'employe_id';

    use Notifiable, Gates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'statut', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employe(){
        return $this->belongsTo(Employe::class);
    }
}