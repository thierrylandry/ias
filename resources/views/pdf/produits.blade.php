@extends("pdf.layout-int")
@section("titre") Inventaire pièce de réchange Toyota - <small>{{ \App\Metier\Mois::getMonthName(date('m'))." ".date('Y') }}</small> @endsection

@section("content")
    <table class="facture">
        <thead>
        <tr class="bg-green">
            <th width="20%">REFERENCE</th>
            <th>DESIGNATION</th>
            <th width="10%">QTE</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ strtoupper($produit->reference) }}</td>
                <td>{{ strtoupper($produit->libelle) }}</td>
                <td valign="center" align="center" style="text-align: center;">{{ number_format($produit->stock,0,","," ") }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection