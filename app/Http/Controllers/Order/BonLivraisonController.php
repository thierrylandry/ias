<?php

namespace App\Http\Controllers\Order;

use App\Application;
use App\PieceComptable;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class BonLivraisonController extends Controller
{
    public function makeBonLivraison($id)
    {
        try{
            $pieceComptable = PieceComptable::findOrFail($id);

            if($pieceComptable->referencebl == null)
            {
                $pieceComptable->referencebl = Application::getNumeroBL(true);
                $pieceComptable->creationbl = Carbon::now()->toDateTimeString();
                $pieceComptable->etat = Statut::PIECE_COMPTABLE_FACTURE_AVEC_BL;
                $pieceComptable->save();
            }

            return redirect()->route("print.piececomptable", ["reference" => $pieceComptable->referencebl, "state" => PieceComptable::BON_LIVRAISON]);

        }catch (ModelNotFoundException $e){
            return back()->withErrors("La facture est introuvable ! Veuillez recommencer SVP");
        }
    }
}