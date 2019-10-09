@extends("pdf.layout")
@section("titre") LISTE DES VEHICULES @endsection

@section("content")
    <table class="facture">
        <thead>
        <tr class="">
            <th>Immatriculation</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Genre</th>
            <th>Exp. visite</th>
            <th>Exp. assurance</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vehicules as $vehicule)
            <tr>
                <td valign="center">{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->marque }}</td>
                <td>{{ $vehicule->typecommercial }}</td>
                <td>{{ $vehicule->genre->libelle }}</td>
                <td>{{ (new \Carbon\Carbon($vehicule->visite))->format('d/m/Y') }}</td>
                <td>{{ (new \Carbon\Carbon($vehicule->assurance))->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection