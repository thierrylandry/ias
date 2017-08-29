@extends("pdf.layout")
@section("titre")  PRO FORMA @endsection
@section("titre-complement")
    <div class="row quatre-cm"><strong>Client :</strong> <br/>{{ $piece->partenaire->raisonsociale }}</div>
    <div class="row quatre-cm"><strong>N° C.C. :</strong> <br/>{{ $piece->partenaire->comptecontribuable }}</div>
    <div class="row quatre-cm"><strong>Téléphone :</strong> {{ $piece->partenaire->telephone }}</div>
    <br style="clear: both" />
@endsection

@section("content")
    <div class="">
        <div class="row quatre-cm">
            <p><strong>N° Pro forma</strong></p>
            <hr/>
            <p class="item">#{{ $piece->referenceproforma }}</p>
        </div>

        <div class="row quatre-cm">
            <p><strong>Date</strong></p>
            <hr/>
            <p class="item">{{ (new Carbon\Carbon($piece->creationproforma))->format("d/m/Y") }}</p>
        </div>

        <div class="row" style="width: 9cm; margin: 0 0.5cm">
            <p><strong>Emetteur</strong></p>
            <hr/>
            <p class="item">{{ $piece->utilisateur->employe->nom }} {{ $piece->utilisateur->employe->prenoms }}</p>
        </div>

        <!--
        <div class="row" style="width: 6cm; margin: 0 0.5cm">
            <p><strong>Emmetteur</strong></p>
            <hr/>
            <p class="item"></p>
        </div>
        -->
    </div>
    <br style="clear: both"/>
    <br/>
    <br/>
    <br/>

    <div class="objet"><span><strong>Objet : </strong>{{ $piece->objet }}</span></div>
    <br/>
    <br/>
    <table>
        <thead>
        <tr class="">
            <th width="7%">Référence</th>
            <th width="45%">Désignation</th>
            <th width="12%" class="amount">P.U HT</th>
            <th class="quantity">Quantité</th>
            <th width="15%" class="amount">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($piece->lignes as $ligne)
        <tr>
            <td class="center">{{ $loop->index + 1 }}</td>
            <td>{{ $ligne->designation }}</td>
            <td class="amount">{{ number_format($ligne->prixunitaire,0,',',' ') }}</td>
            <td class="quantity">{{ number_format($ligne->quantite,0,',',' ') }}</td>
            <td class="amount">{{ number_format($ligne->prixunitaire * $ligne->quantite,0,',',' ') }}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" class="amount">Montant HT</td>
                <td class="amount">{{ number_format($piece->montantht,0,','," ") }} FCFA</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" class="amount">TVA 18% @if($piece->isexonere)<small>(Exonéré de TVA)</small> @endif</td>
                <td class="amount">{{ number_format(($piece->montantht * $piece->tva),0,','," ") }} FCFA</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" class="amount h3">Montant TTC</td>
                <td class="amount h3">{{ number_format(($piece->montantht * ($piece->isexonere ? 1 : (1 + $piece->tva) )),0,','," ") }} FCFA</td>
            </tr>
        </tfoot>
    </table>

    <div class="">
        <p class="h3">Arrêté la présente facture pro forma à la somme de {{ \App\Metier\Finance\NombreToLettre::getLetter(ceil($piece->montantht * ($piece->isexonere ? 1 : (1 + $piece->tva) ))) }} francs CFA.</p>

        <br/>
        <br/>
        <br/>
        <br/>

        <span class="h3">CONDITIONS</span>
        <hr/>
        <div class="condition">
            <p><span class="condition-title">Conditions de paiement : </span>{{ $piece->conditions }}</p>
            <p><span class="condition-title">Delai de livraison : </span>{{ $piece->delailivraison }}</p>
            <p><span class="condition-title">Validité de l'offre : </span>{{ $piece->validite }}</p>
        </div>
    </div>
@endsection