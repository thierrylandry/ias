<?php

namespace App\Http\Controllers\Money;

use App\Brouillard;
use App\Metier\Behavior\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrouillardController extends Controller
{
    public function registre(){
        $debut = Carbon::now()->firstOfMonth()->toDateTimeString();
        $fin = Carbon::now()->toDateTimeString();

        $last = Brouillard::latest('dateaction')->first();
        $solde = $last != null ? $last->balance : 0;

        $lignes = Brouillard::with('utilisateur')
            ->whereBetween('dateaction', [$debut, $fin])
            ->orderBy('dateaction', 'desc')
            ->paginate(30);
        return view('brouillard.registre', compact("lignes", "solde"));
    }

    public function addNewLine(Request $request){
        $this->validRequest($request);

        $old = Brouillard::latest('dateaction')->first();

        $brouillard = new Brouillard($request->except('_token', 'sens', 'montant'));
        $brouillard->dateecriture = Carbon::createFromFormat('d/m/Y', $request->input('dateecriture'))->toDateString();
        $brouillard->dateaction = Carbon::now()->toDateTimeString();
        $brouillard->montant = intval($request->input('sens')) * $request->input('montant');
        $brouillard->balance = $old != null ? $old->balance + $brouillard->montant : $brouillard->montant ;
        $brouillard->employe_id = Auth::id();

        $brouillard->save();

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Mouvement de caisse enregistré avec succès !");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    private function validRequest(Request $request){
        $this->validate($request, [
            'dateecriture' => 'required|date_format:d/m/Y',
            'objet' => 'required',
            'montant' => 'required|integer',
            'observation' => 'present',
            'sens' => 'required|in:1,-1'
        ]);
    }
}
