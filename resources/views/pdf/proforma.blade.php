@extends("pdf.layout")
@section("titre") PRO FORMA @endsection
@section("titre-complement")
    <div class="row quatre-cm">Client :<br/><strong>{{ $pieceComptable->partenaire->raisonsociale }}</strong> </div>
    <div class="row quatre-cm">N° C.C. :<br/><strong>{{ $pieceComptable->partenaire->comptecontribuable }}</strong> </div>
    <div class="row quatre-cm">Téléphone :<br/> <strong>{{ $pieceComptable->partenaire->telephone }}</strong> </div>
    <br style="clear: both" />
@endsection

@section("content")
    <div class="">
        <div class="row" style="width: 6cm; margin: 0 0.5cm">

        </div>

        <div class="row quatre-cm">
            <p><strong>N° Pro forma</strong></p>
            <hr/>
            <p class="item">{{ \App\Application::getprefixOrder() }}{{ $pieceComptable->referenceproforma }}</p>
        </div>

        <div class="row quatre-cm">
            <p><strong>Date</strong></p>
            <hr/>
            <p class="item">{{ (new Carbon\Carbon($pieceComptable->creationproforma))->format("d/m/Y") }}</p>
        </div>

        <div class="row quatre-cm">
            <p><strong>Emetteur</strong></p>
            <hr/>
            <p class="item">{{ $pieceComptable->utilisateur->employe->nom }} {{ $pieceComptable->utilisateur->employe->prenoms }}</p>
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

    <div class="objet"><span><strong>Objet : </strong>{{ $pieceComptable->objet }}</span></div>
    <br/>
    <br/>
    <table>
        <thead>
        <tr class="">
            <th width="15%">Référence</th>
            <th width="45%">Désignation</th>
            <th width="10%" class="amount">P.U HT</th>
            <th class="quantity">Quantité</th>
            <th width="15%" class="amount">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pieceComptable->lignes as $ligne)
        <tr>
            <td class="center">{{ $ligne->reference ? $ligne->reference : "#" }}</td>
            <td>{{ ucfirst($ligne->designation) }}</td>
            <td class="amount">{{ number_format($ligne->prixunitaire,0,',',' ') }}</td>
            <td class="quantity">{{ number_format($ligne->quantite,0,',',' ') }}</td>
            <td class="amount">{{ number_format($ligne->prixunitaire * $ligne->quantite,0,',',' ') }}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" class="amount h3">Montant HT</td>
                <td class="amount h3">{{ number_format($pieceComptable->montantht,0,','," ") }} FCFA</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" class="amount h3">TVA 18% @if($pieceComptable->isexonere)<small>(Exonéré de TVA)</small> @endif</td>
                <td class="amount h3">{{ number_format(ceil($pieceComptable->montantht * $pieceComptable->tva),0,','," ") }} FCFA</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2" class="amount h3">Montant TTC</td>
                <td class="amount h3">{{ number_format(ceil($pieceComptable->montantht * ($pieceComptable->isexonere ? 1 : (1 + $pieceComptable->tva) )),0,','," ") }} FCFA</td>
            </tr>
        </tfoot>
    </table>

    <div class="">
        <p class="h3">Arrêté la présente facture pro forma à la somme de {{ \App\Metier\Finance\NombreToLettre::getLetter(ceil($pieceComptable->montantht * ($pieceComptable->isexonere ? 1 : (1 + $pieceComptable->tva) ))) }} francs CFA.</p>

        <br/>
        <br/>
        <br/>
        <br/>

        <span class="h3">CONDITIONS</span>
        <hr/>
        <div class="condition">
            <p><span class="condition-title">Conditions de paiement : </span>{{ $pieceComptable->conditions }}</p>
            <p><span class="condition-title">Delai de livraison : </span>{{ $pieceComptable->delailivraison }}</p>
            <p><span class="condition-title">Validité de l'offre : </span>{{ $pieceComptable->validite }}</p>
        </div>
    </div>
@endsection