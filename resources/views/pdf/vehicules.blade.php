@extends("pdf.layout-int")
@section("titre") LISTE DES VEHICULES @endsection

@section("content")
    <table class="with-border table-bordered table-hover ">
        <thead>
        <tr class="">
            <th width="9%">Immatriculation</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Genre</th>
            <th width="12%">Exp. visite</th>
            <th width="12%">Exp. assurance</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vehicules as $vehicule)
            <tr>
                <td class="text-center">{{ $vehicule->immatriculation }}</td>
                <td class="text-center">{{ $vehicule->marque }}</td>
                <td class="text-center">{{ $vehicule->typecommercial }}</td>
                <td class="text-center">{{ $vehicule->genre->libelle }}</td>
                <td class="text-center">{{ (new \Carbon\Carbon($vehicule->visite))->format('d/m/Y') }}</td>
                <td class="text-center">{{ (new \Carbon\Carbon($vehicule->assurance))->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection