<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 02/12/2017
 * Time: 11:07
 */

namespace App\Http\Controllers\Stock;


use App\Famille;
use App\Produit;

trait ProduitCrud
{
    /**
     * @param array $data
     * @return Produit
     */
    protected function persitProduct(array $data, Produit $produit = null)
    {
        if(!$produit){
            $produit = new Produit();
        }

        $produit->reference = $data["reference"];
        $produit->libelle = $data["libelle"];
        $produit->prixunitaire = $data["prixunitaire"];
        $produit->famille()->associate(Famille::find($data["famille_id"]));

        $produit->saveOrFail();

        return $produit;
    }

    /**
     * @param $reference
     * @return bool
     */
    protected function checkReferenceExist($reference){
        if(Produit::where("reference",$reference)->count() > 0){
            return true;
        }else{
            return false;
        }
    }
}