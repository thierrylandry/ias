<?php

namespace App\Http\Controllers\Order;

use App\Metier\Behavior\Notifications;
use App\Metier\Finance\InvoiceFrom;
use App\Mission;
use App\Partenaire;
use App\Produit;
use App\Statut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class CommandeController extends Controller
{
    public function nouvelle(Request $request)
    {
        //TODO : Faire la route pour le bon de commande issu de la mission et éditer son PDF. Après création du mail,
        // proposer d'envoyer la pro forma par email si le client dispose d'un champ email puis envoie à la sélection
        // en mettant commercial@ivoireautoservices.net en copie

        $lignes = new Collection();

        //Si une mission est passée en session
        if($request->session()->has(Notifications::MISSION_OBJECT))
        {
            $commercializables = $request->session()->get(Notifications::MISSION_OBJECT);

            if(!is_array($commercializables)){
                $commercializables = collect([$commercializables]);
            }


            $lignes = $commercializables;
        }else{ //Facture sanss intention préalable
            $commercializables = $this->getCommercializableList($request);
        }

        return $this->nouvelleProforma($commercializables, $lignes);
    }

    protected function nouvelleProforma(Collection $commercializables, Collection $lignes)
    {
        $partenaires = $this->getPartenaireList(\request());
        return view('order.proforma', compact("commercializables", "partenaires", "lignes"));
    }

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
}
