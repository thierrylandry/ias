<?php

namespace App\Http\Controllers\Stock;

use App\Famille;
use App\Http\Controllers\Controller;
use App\Metier\Behavior\Notifications;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    use ProduitCrud;

    public function ajouter()
    {
        $familles = Famille::orderBy("libelle")->get();
        return view("produit.nouveau", compact("familles"));
    }

    public function addProduct(Request $request)
    {
        $this->valideRequest($request);
        $produit = $this->createProduct($request->input());

        if($request->query("from") == "proforma"){ //On provient du popup de la fenêtre de nouvelle pro forma
            $json = json_encode([
                "id" => $produit->id,
                "modele" => $produit->getRealModele(),
                "price" => $produit->getPrice(),
                "libelle" => $produit->detailsForCommande(),
                "reference" => $produit->getReference(),
            ],JSON_UNESCAPED_UNICODE);

            $request->session()->flash("produit", str_replace("\\\\","\/",$json));
        }else{
            //
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Produit ajouté avec succès !");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    /**
     * @param Request $request
     * @return $this|null
     */
    protected function valideRequest(Request $request){
        $this->validate($request,[
            "reference" => "required",
            "libelle" => "required",
            "prixunitaire" => "integer",
            "famille_id" => "required|exists:famille,id"
        ]);

        if($this->checkReferenceExist($request->input("reference"))){
            return redirect()->back()->withErrors("La référence du produit existe déjà.")
                ->withInput();
        }
        return null;
    }
}
