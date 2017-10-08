<?php

namespace App;

use App\Http\Controllers\Order\Commercializable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model implements Commercializable
{
    protected $table = 'mission';
    protected $guarded = [];
    public $timestamps = false;

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class,"chauffeur_id");
    }

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function clientPartenaire(){
        return $this->belongsTo(Partenaire::class,"client");
    }

    public function soustraitantPartenaire(){
        return $this->belongsTo(Partenaire::class,"soustraitant");
    }

    public function pieceComptable(){
        return $this->belongsTo(PieceComptable::class,"piececomptable_id");
    }

    public function versements(){
        return $this->hasMany(Versement::class, "mission_id", "id");
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function detailsForCommande()
    {
        return sprintf("Location de véhicule %s immatriculé %s pour %s jours (du %s au %s). Destination(s) : %s",
            $this->vehicule->genre->libelle." ".$this->vehicule->marque." ".$this->vehicule->typecommercial,
                $this->vehicule->immatriculation,
            (new Carbon($this->debutprogramme))->diffInDays(new Carbon($this->finprogramme)),
            (new Carbon($this->debutprogramme))->format("d/m/Y"),
            (new Carbon($this->finprogramme))->format("d/m/Y"),
            $this->destination
        );
    }

    /**
     * @return string
     */
    public function getRealModele()
    {
        return self::class;
    }

    public function getReference()
    {
        return empty($this->code) ? $this->code : "#" ;
    }

    public function getPrice()
    {
        return $this->montantjour ? $this->montantjour : 0 ;
    }

    public function getQuantity()
    {
        return 1;
    }
}