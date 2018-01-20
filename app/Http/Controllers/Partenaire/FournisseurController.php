<?php

namespace App\Http\Controllers\Partenaire;

use App\Http\Controllers\Controller;
use App\Metier\Behavior\Notifications;
use App\Partenaire;
use App\PieceFournisseur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FournisseurController extends Controller
{
    use Factures;

    public function newOrder()
    {
        $partenaires = Partenaire::where('isfournisseur','=',true)->get();
        return view('partenaire.order.nouvelle', compact('partenaires'));
    }

    public function addOrder(Request $request){
        $this->validRequest($request);

        $pieceFournisseur = new PieceFournisseur($request->except('_token'));
        $pieceFournisseur->datepiece = Carbon::createFromFormat('d/m/Y', $request->input('datepiece'));
        $pieceFournisseur->employe_id = Auth::id();
        $pieceFournisseur->save();

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Facture fournisseur enregistrée avec succès !");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    protected function validRequest(Request $request){
        $this->validate($request, [
            'datepiece' => 'required|date_format:d/m/Y',
            'objet' => 'required',
            'reference' => 'required',
            'montant' => 'required|integer',
            'partenaire_id' => 'required|exists:partenaire,id',
            'observation' => 'present'
        ]);
    }
}
