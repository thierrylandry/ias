<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 26/08/2018
 * Time: 10:39
 */

namespace App\Http\Controllers\Stock;


use App\Famille;
use App\Http\Controllers\Controller;

class MouvementController extends Controller {

	public function index()
	{
		$familles = Famille::orderBy("libelle")->get();

		return view('produit.mouvement', compact("familles"));
	}
}