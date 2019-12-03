@extends("pdf.layout")
@section("titre") BON DE COMMANDE @endsection
@section("titre-complement")
    <div class="row quatre-cm">Fournisseur :<br/><strong>{{ $bc->partenaire->raisonsociale }}</strong> </div>
    <div class="row quatre-cm">N° C.C. :<br/><strong>{{ $bc->partenaire->comptecontribuable }}</strong> </div>
    <div class="row quatre-cm">Téléphone :<br/> <strong>{{ $bc->partenaire->telephone }}</strong> </div>
    <br style="clear: both" />
@endsection

@section("content")
    <div class="">
        <div class="row" style="width: 6cm; margin: 0 0.5cm">

        </div>

        <div class="row quatre-cm">
            <p><strong>N° BC</strong></p>
            <hr/>
            <p class="item">{{ \App\Application::getprefixOrder() }}{{ $bc->numerobc }}</p>
        </div>

        <div class="row quatre-cm">
            <p><strong>Date</strong></p>
            <hr/>
            <p class="item">{{ (new Carbon\Carbon($bc->datepiece))->format("d/m/Y") }}</p>
        </div>

        <div class="row quatre-cm">
            <p><strong>Emetteur</strong></p>
            <hr/>
            <p class="item">{{ $bc->utilisateur->employe->nom }} {{ $bc->utilisateur->employe->prenoms }}</p>
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
@endsection