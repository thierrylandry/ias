<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\PieceComptable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    use Process;

    public function liste(Request $request)
    {
        $pieces = $this->getPiecesComptable($request);
        return view("order.liste", compact("pieces"));
    }

    private function getPiecesComptable(Request $request)
    {
        $periode = $this->getPeriode($request);

        return PieceComptable::with("partenaire","lignes")
            ->whereBetween("creationproforma", [$periode->get("debut")->toDateString(), $periode->get("fin")->toDateString()])
            ->orderBy("creationproforma","desc")
            ->paginate(30);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    private function getPeriode(Request $request)
    {
        $debut = Carbon::now()->firstOfMonth();
        $fin = Carbon::now();

        if($request->has("debut"))
            $debut = Carbon::createFromFormat("d/m/Y", $request->input("debut"));

        if($request->has("fin"))
            $fin = Carbon::createFromFormat("d/m/Y", $request->input("fin"));

        return collect(compact("debut", "fin"));
    }


    public function details($reference)
    {
        $piece = $this->getPieceComptableForReference($reference);
        return view("order.facture", compact("piece"));
    }
}
