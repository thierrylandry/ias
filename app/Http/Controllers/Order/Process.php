<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 24/08/2017
 * Time: 08:33
 */

namespace App\Http\Controllers\Order;


use App\Application;
use App\LignePieceComptable;
use App\Metier\Finance\InvoiceFrom;
use App\Mission;
use App\Partenaire;
use App\PieceComptable;
use App\Produit;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait Process
{
    private function getPartenaireList(Request $request)
    {
        return Partenaire::orderBy("raisonsociale")->get();
    }

    private function getCommercializableList(Request $request)
    {
        $commercializables = new Collection();

        if($request->has('from') && $request->input('from') == InvoiceFrom::mission())
        {

        }else{
            $commercializables = collect(Produit::orderBy("libelle")->get());
        }

        collect(Mission::with("vehicule")
            ->where("status",Statut::MISSION_COMMANDEE)
            ->get()
        )->each(function ($value, $key) use($commercializables){
            $commercializables->push($value);
        });

        return $commercializables;
    }

    private function validateProformaRequest(Request $request)
    {
        return Validator::make($request->input(),[
            "lignes.*.id" => "required|numeric",
            "lignes.*.designation" => "required",
            "lignes.*.quantite" => "required|numeric|min:1",
            "lignes.*.prixunitaire" => "required|numeric|min:50",
            "lignes.*.modele" => "required",
            "lignes.*.modele_id" => "required|numeric|min:1",
            "partenaire_id" => "required|exists:partenaire,id",
            "montantht" => "required|numeric",
            "isexonere" => "required|boolean",
        ]);
    }

    private function addLineToPieceComptable(PieceComptable $pieceComptable, array $data)
    {
        foreach ($data as $ligne)
        {
            $lignepiece = new LignePieceComptable($ligne);
            $lignepiece->piececomptable()->associate($pieceComptable);
            $lignepiece->saveOrFail();
        }

        return true;
    }

    /**
     * @param int $type
     * @param Partenaire $partenaire
     * @param Collection $data
     * @param integer|null $id
     * @return PieceComptable
     */
    private function createPieceComptable($type, Partenaire $partenaire, Collection $data, $id=null)
    {
        $piececomptable = new PieceComptable();

        $piececomptable->montantht = $data->get("montantht");
        $piececomptable->isexonere = $data->get("isexonere");

        $piececomptable->partenaire()->associate($partenaire);

        $piececomptable->tva = PieceComptable::TVA;

        if( ($id == null || $id == 0) && $type === PieceComptable::PRO_FORMA)
        {
            $piececomptable->referenceproforma = Application::getInitial().Application::getNumeroProforma(true);
            $piececomptable->creationproforma = Carbon::now()->toDateTimeString();
            $piececomptable->etat = Statut::PIECE_COMPTABLE_PRO_FORMA;
        }

        $piececomptable->saveOrFail();

        return $piececomptable;
    }
}