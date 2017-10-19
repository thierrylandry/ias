<?php

namespace App;

use App\Interfaces\IAmortissement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model implements IAmortissement
{
    public $timestamps = false;
    protected $table = "intervention";
    protected $guarded = [];

    public function typeIntervention(){
        return $this->belongsTo(TypeIntervention::class,"typeintervention_id");
    }

    public function vehicule(){
        return $this->belongsTo(Vehicule::class,"vehicule_id");
    }

    public function getDate()
    {
        return new Carbon($this->debut);
    }

    public function getDetails()
    {
        return sprintf("Intervention : %s, %s", $this->typeIntervention->libelle, $this->details);
    }

    public function getDebit()
    {
        return 0;
    }

    public function getCredit()
    {
        return $this->cout;
    }
}
