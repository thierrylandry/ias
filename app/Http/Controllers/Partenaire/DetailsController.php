<?php

namespace App\Http\Controllers\Partenaire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
    public function fiche($id)
    {
        echo "Fiche client id:".$id;
    }
}
