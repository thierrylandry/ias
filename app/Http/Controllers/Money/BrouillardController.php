<?php

namespace App\Http\Controllers\Money;

use App\Brouillard;
use App\Metier\Behavior\Notifications;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrouillardController extends Controller
{
    public function registre(Request $request){
        $debut = Carbon::now()->firstOfMonth()->toDateTimeString();
        $fin = Carbon::now()->toDateTimeString();

        $last = Brouillard::latest('dateaction')->first();
        $solde = $last != null ? $last->balance : 0;

        $lignes = Brouillard::with('utilisateur')
                     ->orderBy('dateaction', 'desc');

        $lignes = $this->extracData($lignes, $request, $debut, $fin);

        $lignes = $lignes->paginate(30);

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

    public function updateLine(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:lignebrouillard',
            'dateecriture' => 'required|date_format:d/m/Y',
            'objet' => 'required',
        ]);
        try{
            $line = Brouillard::findOrFail($request->input('id'));
            $line->dateecriture = Carbon::createFromFormat('d/m/Y', $request->input('dateecriture'))->toDateString();
            $line->objet = $request->input('objet');
            $line->saveOrFail();
        }catch (ModelNotFoundException | \Exception $e){
            return back()->withErrors('Ligne de brouillard inntrouvable.');
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Ligne brouillard modifiée.");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    /**
     * @param Builder $builder
     * @param Request $request
     * @param $du
     * @param $au
     * @return Builder
     */
    private function extracData(Builder $builder, Request $request, &$du, $au)
    {
        if($request->query('objet'))
        {
            $du = Carbon::createFromFormat('d/m/Y', $request->query('debut'))->setTime(0,0,0)->toDateTimeString();
            $au = Carbon::createFromFormat('d/m/Y', $request->query('fin'))->setTime(23,59,59)->toDateTimeString();

            $objet = $request->query('objet');
            $builder->where('objet','like',"%$objet%");
        }

        $builder->whereBetween('dateaction', [$du, $au]);

        return $builder;
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
