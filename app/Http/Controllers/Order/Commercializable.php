<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 17/08/2017
 * Time: 23:12
 */

namespace App\Http\Controllers\Order;


interface Commercializable
{
    /**
     * @return string
     */
    public function detailsForCommande();

    /**
     * @return string
     */
    public function getRealModele();

    /**
     * @return string
     */
    public function getReference();

    /**
     * @return int
     */
    public function getPrice();
}