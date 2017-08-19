<?php

namespace App;

use App\Http\Controllers\Order\Commercializable;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model implements Commercializable
{
    protected $table = "produit";
    public $timestamps = false;

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
        // TODO: Implement getRealModele() method.
    }

    public function getReference()
    {
        // TODO: Implement getReference() method.
    }

    public function getPrice()
    {
        // TODO: Implement getPrice() method.
    }


}
