<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LignePieceFournisseur extends Model
{
	public $timestamps = false;
	protected $guarded = [];
	protected $table = "lignepiecefournisseur";

	public function piecefournisseur()
	{
		return $this->belongsTo(PieceFournisseur::class);
	}

	public function produit()
	{
		return $this->belongsTo(Produit::class);
	}
}
