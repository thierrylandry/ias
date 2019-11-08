<?php
/**
 * Created by PhpStorm.
 * User: SUPPORT.IT
 * Date: 20/01/2018
 * Time: 16:56
 */

namespace App\Http\Controllers\Partenaire;


use App\Http\Controllers\Order\Commercializable;
use App\Intervention;
use App\PieceFournisseur;
use App\Produit;
use Illuminate\Http\Request;

trait Factures
{
	/**
	 * @return \Illuminate\Support\Collection|Commercializable
	 */
	private function getCommercializableList()
	{
		$commercializables = collect(Produit::orderBy("libelle")->get());

		collect(Intervention::with("vehicule","typeIntervention")
		               ->whereNotNull("partenaire_id")
		               ->whereNull("piecefournisseur_id")
		               ->get()
		)->each(function ($value, $key) use($commercializables){
			$commercializables->push($value);
		});

		return $commercializables;
	}

	private function updateIntervention(int $interventionId, PieceFournisseur $piece)
	{
		$intervention = Intervention::find($interventionId);
		if($intervention)
		{
			$intervention->piecefournisseur_id = $piece->id;
			$intervention->save();
		}
	}

	private function updateStock(int $produit, int $qte)
	{
		$produit = Produit::find($produit);
		if($produit)
		{
			$produit->stock += $qte;
			$produit->save();
		}
	}

	protected function validRequest(Request $request){
		$this->validate($request, [
			'datepiece' => 'required|date_format:d/m/Y',
			'objet' => 'required',
			'reference' => 'required',
			'montanttva' => 'required|integer',
			'montantht' => 'required|integer',
			'produit_id' => 'required|array',
			'prix' => 'required|array',
			'quantite' => 'required|array',
			'modele' => 'required|array',
			'designation' => 'required|array',
			'partenaire_id' => 'required|exists:partenaire,id',
			'observation' => 'present'
		]);
	}
}