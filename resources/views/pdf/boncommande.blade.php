@extends("pdf.layout-bc")
@section("titre")BON DE COMMANDE <br/> <br/>@endsection
@section("reference")
    <p class="t1">N° : <strong>{{ \App\Application::getprefixOrder() }}{{ $bc->numerobc }}</strong></p><br/>
    <p>Date : <strong>{{ (new Carbon\Carbon($bc->datepiece))->format("d/m/Y") }}</strong></p>
    <p>Emetteur : <strong>{{ $bc->utilisateur->employe->nom }} {{ $bc->utilisateur->employe->prenoms }}</strong></p>
    <p>Contact : <strong>(+225) 24 00 25 54 / 07 93 97 12</strong></p>
@endsection
@section("client")
    <p class="t1"><strong>{{ $bc->partenaire->raisonsociale }}</strong></p><br/>
    <p>N° C.C. : <strong>{{ $bc->partenaire->comptecontribuable }}</strong> </p>
    <p>Téléphone : <strong>{{ $bc->partenaire->telephone }}</strong> </p>
    <br style="clear: both" />
@endsection

@section("content")
    <br style="clear: both"/>
    <div class="objet"><span><strong>Objet : </strong>{{ $bc->objet }}</span></div>
    <br/>
    <br/>
    <table>
        <thead>
        <tr class="">
            <th width="15%">Référence</th>
            <th width="35%">Désignation</th>
            <th width="10%" class="amount">P.U HT</th>
            <th class="quantity">Quantité</th>
            <th width="20%" class="amount">Montant</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bc->lignes as $ligne)
            <tr>
                <td class="center">{{ $ligne->reference ? $ligne->reference : "#" }}</td>
                <td>{{ ucfirst($ligne->designation) }}</td>
                <td class="amount">{{ number_format($ligne->prix,0,',',' ') }}</td>
                <td class="quantity">{{ number_format($ligne->quantite,0,',',' ') }}</td>
                <td class="amount">{{ number_format(($ligne->prix * $ligne->quantite),0,',',' ') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="1" class="amount h4">Montant HT</td>
            <td colspan="2" class="amount h4">{{ number_format($bc->montantht,0,','," ") }} </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="1" class="amount h4">TVA 18%</td>
            <td colspan="2" class="amount h4">{{ number_format(ceil($bc->montanttva),0,','," ") }} </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="1" class="amount h3">Montant TTC</td>
            <td colspan="2" class="amount h3">{{ number_format(ceil($bc->montantht + $bc->montanttva),0,','," ") }} </td>
        </tr>
        </tfoot>
    </table>

    <div class="">
        <p class="h3">Arrêté le présent bon de commande à la somme de {{ \App\Metier\Finance\NombreToLettre::getLetter(ceil($bc->montantht  + $bc->montanttva)) }} francs CFA.</p>

        <br/>
        <br/>
        <br/>
        <br/>

    <!--
        <span class="h3">CONDITIONS</span>
        <hr/>
        <div class="condition">
            <p><span class="condition-title">Conditions de paiement : </span>{{ $bc->conditions }}</p>
            <p><span class="condition-title">Delai de livraison : </span>{{ $bc->delailivraison }}</p>
            <p><span class="condition-title">Validité de l'offre : </span>{{ $bc->validite }}</p>
        </div>
        -->
    </div>
    <div style="margin-left: 10cm;" class="row six-cm">
        @if($bc->statut == \App\Statut::PIECE_COMPTABLE_BON_COMMANDE_VALIDE)
        <img alt="signature" width="300" src="{{ asset('images/signature.jpg') }}"/>
        @endif
    </div>
    <br class="clearfix" />
@endsection