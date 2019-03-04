<?php

namespace App;

use App\Http\Controllers\Order\Commercializable;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model implements Commercializable
{
    protected $table = "produit";
    public $timestamps = false;
    public $quantite = 1;
    public $modele = self::class;

    public function famille()
    {
        return $this->belongsTo(Famille::class);
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
        return $this->libelle;

        /*
        return sprintf("%s , %s",
            $this->famille->libelle,
            $this->libelle
        ); */
    }

    /**
     * @return string
     */
    public function getRealModele()
    {
        return $this->modele;
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
        return $this->quantite;
    }

	/**
	 * @return float
	 */
	public function getRemise() {
		return $this->remise;
	}
}
