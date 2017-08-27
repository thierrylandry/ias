@extends("pdf.layout")
@section("titre")  PRO FORMA @endsection

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

        <div class="row quatre-cm">
            <p><strong>Validité de l'offre</strong></p>
            <hr/>
            <p class="item">30 jours</p>
        </div>

        <div class="row" style="width: 6cm; margin: 0 0.5cm">
            <p><strong>Client</strong></p>
            <hr/>
            <p class="item">{{ $piece->partenaire->raisonsociale }}</p>
        </div>
    </div>
    <br style="clear: both"/>
    <br/>
    <br/>
    <br/>

    <div class="objet"><span><strong>Objet : </strong>Mission à l'intérieur du pays</span></div>
    <br/>
    <br/>
    <table>
        <thead>
        <tr class="">
            <th width="7%">Référence</th>
            <th>Description</th>
            <th width="10%" class="amount">Prix </th>
            <th width="8%">Quantité</th>
            <th width="12%" class="amount">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($piece->lignes as $ligne)
        <tr>
            <td class="center">{{ "#" }}</td>
            <td>{{ $ligne->designation }}</td>
            <td class="amount">{{ $ligne->prixunitaire }}</td>
            <td class="amount">{{ $ligne->quantite }}</td>
            <td class="amount">{{ $ligne->prixunitaire * $ligne->quantite }}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Montant HT</td>
                <td class="amount">{{ number_format(45000,0,','," ") }} FCFA</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>TVA 18%</td>
                <td class="amount">{{ number_format(4500,0,','," ") }} FCFA</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="amount h3">Montant TTC</td>
                <td class="amount h3">{{ number_format(455000,0,','," ") }} FCFA</td>
            </tr>
        </tfoot>
    </table>

    <div class="">
        <span class="underline h3"><strong>Conditions & termes</strong></span>
        <p><br/>Facture arrêtée à la somme de {{ \App\Metier\Finance\NombreToLettre::getLetter(455000) }} francs CFA.</p>
        <p></p>
    </div>


@endsection