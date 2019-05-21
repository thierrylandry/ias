<?php

namespace App\Http\Controllers\Stock;

use App\Famille;
use App\Http\Controllers\Controller;
use App\Metier\Behavior\Notifications;
use App\Produit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    use ProduitCrud;

    public function ajouter()
    {
        $familles = Famille::orderBy("libelle")->get();
        return view("produit.nouveau", compact("familles"));
    }

	/**
	 * @param Request $request
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse|null
	 * @throws \Throwable
	 */
    public function addProduct(Request $request)
    {
        $this->valideRequest($request);

        //On vérifie la que la référence n'est pas utilisée par un autre produit
        if($this->checkReferenceExist($request->input("reference"))){
            return redirect()->back()->withErrors("La référence du produit existe déjà.")
                ->withInput();
        }

	    $produit = $this->persitProduct($request->input());

        if($request->query("from") == "proforma"){ //On provient du popup de la fenêtre de nouvelle pro forma
            $json = json_encode([
                "id" => $produit->id,
                "modele" => $produit->getRealModele(),
                "price" => $produit->getPrice(),
                "libelle" => $produit->detailsForCommande(),
                "reference" => $produit->getReference(),
            ],JSON_UNESCAPED_UNICODE);

            $request->session()->flash("produit", str_replace("'","\'",str_replace("\\\\","\\", $json) ));
            return null;
        }else{
	        $notification = new Notifications();
	        $notification->add(Notifications::SUCCESS,"Produit ajouté avec succès !");
	        return redirect()->route("stock.produit.ajouter",["from" => "newOrder"])->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
        }

    }

    /**
     * @param Request $request
     */
    protected function valideRequest(Request $request)
    {
        $this->validate($request,[
            "reference" => "required",
            "libelle" => "required",
            "prixunitaire" => "integer",
            "famille_id" => "required|exists:famille,id"
        ]);
    }

    public function liste(Request $request)
    {
        $keyword = null;

        $familles = Famille::orderBy("libelle")->get();

        $produits = Produit::with("famille")
            ->orderBy("reference", 'asc');

        $this->filter($produits, $request);

        $produits = $produits->paginate(25);

        return view("produit.liste", compact("produits","familles"));
    }

    public function classProduct(Request $request){
	    $familles = Famille::orderBy("libelle")->get();
	    $produits = $this->getProduitRatio(Carbon::now()->setDate(2019,01,01), Carbon::now());
	    return view("produit.ratio", compact("produits","familles"));
    }

    private function filter(Builder &$builder, Request $request)
    {
        if(!empty($request->query('famille')) && $request->query('famille') != "all")
        {
            $builder->where("famille_id", $request->query("famille"));
        }

        if(!empty($request->query('keyword')))
        {
            $keyword = $request->query('keyword');
            $builder->whereRaw("( reference like '%{$keyword}%' OR libelle like '%{$keyword}%')");
        }
    }

    public function modifier($reference)
    {
        $familles = Famille::orderBy("libelle")->get();
        try{
            $produit = Produit::with("famille")->where("reference", $reference)->firstOrFail();
        }catch (ModelNotFoundException $e){
           return back()->withErrors("Le produit spécifié n'existe pas.");
        }
        return view("produit.modifier", compact("produit","familles"));
    }

    public function update($reference, Request $request)
    {
        $this->valideRequest($request);

        try{
            $produit = Produit::with("famille")->where("reference", $reference)->firstOrFail();
            $this->persitProduct($request->except('_token'), $produit);
        }catch (ModelNotFoundException $e){
            return back()->withErrors("Une erreur de mise à jour a été rencontrée.");
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Produit modifié avec succès !");
        return redirect()->route("stock.produit.liste")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }
}
