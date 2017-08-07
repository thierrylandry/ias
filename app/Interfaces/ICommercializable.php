<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 25/07/2017
 * Time: 16:05
 */

namespace App\Interfaces;


interface ICommercializable
{
    /**
     * @return mixed
     * @inheritdoc Fournit une chaine pour détailler l'objet pour un bon de commande et autre pièces comptable
     */
    public function detailsForCommande();


    /**
     * @return mixed
     * @inheritdoc Permet de redonner la classe d'originne de la ligne de la commande
     */
    public function getRealModele();
}