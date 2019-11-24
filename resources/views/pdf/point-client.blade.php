@extends("pdf.layout-int")
@section("titre") Situation Client - <b>{{ $partenaire->raisonsociale }}</b> @endsection
@php
    $rap = 0;
@endphp
@section("content")
    <table class="table with-border table-bordered table-hover">
        <thead>
        <tr class="bg-green">
            <th>Date</th>
            <th>N° Facture</th>
            <th>N° Pro forma</th>
            <th>Objet</th>
            <th>Montant</th>
            <th>Statut</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pieces as $piece)
            <tr>
                <td>{{ (new \Carbon\Carbon($piece->creationfacture ?? $piece->creationproforma))->format('d/m/Y') }}</td>
                <td><a href="{{ route('facturation.details',['refrence' => $piece->referenceproforma]) }}">{{ $piece->referencefacture }}</a></td>
                <td><a href="{{ route('facturation.details',['refrence' => $piece->referenceproforma]) }}">{{ $piece->referenceproforma }}</a></td>
                <td>{{ $piece->objet }}</td>
                <td>{{ number_format($piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva), 0, '', ' ') }}</td>
                <td>{{ \App\Statut::getStatut($piece->etat) }}</td>
            </tr>
            @php
                if(!in_array($piece->etat ,[\App\Statut::PIECE_COMPTABLE_FACTURE_PAYEE, \App\Statut::PIECE_COMPTABLE_PRO_FORMA, \App\Statut::PIECE_COMPTABLE_FACTURE_ANNULEE])){
                    $rap += $piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva);
                }
            @endphp
        @endforeach
        <tr>
            <td colspan="6"><h5>Total : {{ number_format($rap, 0, '', ' ') }} F CFA</h5></td>
        </tr>
        </tbody>
    </table>
@endsection