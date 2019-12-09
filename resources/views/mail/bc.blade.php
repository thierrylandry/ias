@extends("mail.layout")
@section("content")
    <br/>
    <p>Bonjour Monsieur,</p>
    <p>Veuillez valider la commande ci-dessous qui pour objet : <b>{{ $piece->objet }}</b></p>
    <hr/>
    <a href="{{ route("partenaire.fournisseur.factures.details", ["id" => $piece->id]) }}">Valider la commande</a>
    <ul>
        <li>Fournisseur : <b>{{ $piece->fournisseur->raisonsociale }}</b></li>
        <li>Montant : {{ number_format($piece->montanttva + $piece->montantht, 0, " ", " ") }} FCFA</li>
    </ul>
    <br/>
    <p>Mail envoyé le {{ date("d/m/Y") }}</p>
@endsection