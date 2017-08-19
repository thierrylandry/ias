<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 18/08/2017
 * Time: 21:13
 */

namespace App\Http\Controllers\Mission;


trait Process
{
    public function validateMission()
    {
        return [
            "code" => "present",
            "destination" => "required",
            "debutprogramme" => "required",
            "finprogramme" => "required|date_format:d/m/Y",
            "perdiem" => "numeric",
            "chauffeur_id" => "required|numeric",
            "vehicule_id" => "required|numeric",
            "client" => "required|numeric",
        ];
    }
}