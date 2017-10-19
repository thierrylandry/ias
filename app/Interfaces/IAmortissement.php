<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 15/10/2017
 * Time: 21:58
 */

namespace App\Interfaces;


interface IAmortissement
{
    public function getDate();
    public function getDetails();
    public function getDebit();
    public function getCredit();
}