<?php

namespace App;

use App\Http\Controllers\Order\Commercializable;
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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Commercializable|null
	 */
	public function commercializable()
	{
		if($this->modele == null || empty($this->modele) )
		{
			return null;
		}

		return $this->belongsTo($this->modele, $this->modele_id);
	}
}
