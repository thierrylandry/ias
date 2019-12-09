@extends("pdf.layout-int")
@section("titre") Synthèse des comptes @endsection

@section("content")
    <table class="table with-border table-bordered table-hover">
        <thead>
        <tr class="bg-green">
            <th width="11%">Date action</th>
            <th width="20%">Compte</th>
            <th width="43%">Objet</th>
            <th width="13%">Montant</th>
            <th width="13%">Balance</th>
        </tr>
        </thead>
        <tbody class="table-hover">
        @foreach($lignes as $ligne)
            <tr>
                <td>{{ (new \Carbon\Carbon($ligne->dateoperation))->format('d/m/Y') }}</td>
                <td>{{ $ligne->compte->libelle }}</td>
                <td>{{ $ligne->objet }}</td>
                <td class="amount"><a title="{{ $ligne->observation }}">{{ number_format($ligne->montant, 0, ',',' ') }}</a></td>
                <td class="amount">{{ number_format($ligne->balance, 0, ',',' ') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection