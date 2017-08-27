<?php

namespace App\Http\Controllers\Order;

use App\Metier\Behavior\Notifications;
use App\Partenaire;
use App\PieceComptable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ProformaController extends Controller
{
    use Process;

    public function nouvelle(Request $request)
    {
        $lignes = new Collection();
        $commercializables = null;

        //Si une mission est passée en session
        if($request->session()->has(Notifications::MISSION_OBJECT))
        {
            $commercializables = $request->session()->get(Notifications::MISSION_OBJECT);

            if(!is_array($commercializables)){
                $commercializables = collect([$commercializables]);
            }

            $lignes = $commercializables;
        }else{ //Facture sans intention préalable
            $commercializables = $this->getCommercializableList($request);
        }

        $partenaires = $this->getPartenaireList($request);

        return view('order.proforma', compact("commercializables", "partenaires", "lignes"));
    }

    public function ajouter(Request $request)
    {
        $validator = $this->validateProformaRequest($request);

        if($validator->fails()){
            return response()->json(["code" => 0, "message" => "La validation de la pro forma a échouée"],400);
        }

        $paretenaire = new Partenaire(['id' => $request->input("partenaire_id")]);

        $piececomptable = $this->createPieceComptable(PieceComptable::PRO_FORMA, $paretenaire, collect($request->only(["montantht", "isexonere"])));

        $this->addLineToPieceComptable($piececomptable,$request->input("lignes"));

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Votre proforma n° $piececomptable->referenceproforma a été prise en compte.");

        return response()->json([
            "code" => 1,
            "message" => "Nouvelle pro forma référence $piececomptable->referenceproforma enregistrée avec succès !",
            "action" => route("facturation.envoie.emailchoice",["reference" => $piececomptable->referenceproforma])
        ],200, [],JSON_UNESCAPED_UNICODE);
    }
}