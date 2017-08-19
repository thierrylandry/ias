<?php

namespace App;

use App\Http\Controllers\Order\Commercializable;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model implements Commercializable
{
    protected $table = 'mission';
    protected $guarded = [];
    public $timestamps = false;

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class);
    }

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function client(){
        return $this->belongsTo(Partenaire::class,"client");
    }

    public function soustraitant(){
        return $this->belongsTo(Partenaire::class,"soustraitant");
    }

    /**
     * @return string
     */
    public function detailsForCommande()
    {
        // TODO: Implement detailsForCommande() method.
    }

    /**
     * @return string
     */
    public function getRealModele()
    {
        return typeOf($this);
    }

    public function getReference()
    {
        $this->code ? $this->code : "#";
    }

    public function getPrice()
    {
        $this->montantjour ? $this->montantjour : 0 ;
    }
}
