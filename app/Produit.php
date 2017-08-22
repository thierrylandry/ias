<?php

namespace App;

use App\Http\Controllers\Order\Commercializable;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model implements Commercializable
{
    protected $table = "produit";
    public $timestamps = false;

    public function famille()
    {
        return $this->belongsTo(Famille::class);
    }

    /**
     * @return string
     */
    public function detailsForCommande()
    {
        return sprintf("%s , %s",
            $this->famille->libelle,
            $this->libelle
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
        return $this->reference;
    }

    public function getPrice()
    {
        return $this->prixunitaire;
    }

    public function getQuantity()
    {
        return 1;
    }
}
