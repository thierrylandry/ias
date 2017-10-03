<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\PieceComptable;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    use Process;

    public function listeProforma(Request $request)
    {
        return $this->liste($request, PieceComptable::PRO_FORMA);
    }

    public function liste(Request $request, $proforma = null)
    {
        $pieces = $this->getPiecesComptable($request, $proforma);
        return view("order.liste", compact("pieces"));
    }

    /**
     * @param Request $request
     * @param null | int $type
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getPiecesComptable(Request $request, $type = null)
    {
        $periode = $this->getPeriode($request);

        $raw = PieceComptable::with("partenaire","lignes")
            ->whereBetween("creationproforma", [$periode->get("debut")->toDateString(), $periode->get("fin")->toDateString()]);

        if($type){
            switch ($type){
                case PieceComptable::PRO_FORMA : $raw->where("etat", "=", Statut::PIECE_COMPTABLE_PRO_FORMA); break;

                default : null;
            };
        }

        $raw->orderBy("creationproforma","desc");

        return $raw->paginate(30);
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
