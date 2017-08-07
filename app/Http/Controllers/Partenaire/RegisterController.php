<?php

namespace App\Http\Controllers\Partenaire;

use App\Partenaire;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function liste($type)
    {
        $partenaires = Partenaire::orderBy('raisonsociale','asc');

        $partenaires = $this->triPartenaire($type, $partenaires)->get();

        return view('partenaire.liste', compact('partenaires'));
    }


    /**
     * @param $type
     * @param Builder $builder
     * @return Builder
     */
    private function triPartenaire($type,Builder $builder)
    {
        if($type == Partenaire::FOURNISSEUR)
        {
            $builder->where('isfournisseur',true);
        }

        if($type == Partenaire::CLIENT)
        {
            $builder->where('isclient', true);
        }
        return $builder;
    }
}
