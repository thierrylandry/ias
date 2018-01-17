@extends("layouts.main")
@section("content")
@php
$rap = 0;
@endphp
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3>Point partenaire : {{ $partenaire->raisonsociale }}</h3>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-green">
                            <th>Date</th>
                            <th>N° Facture</th>
                            <th>N° Pro forma</th>
                            <th>N° BL</th>
                            <th>Objet</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Moyen Paiement</th>
                            <th>Date de paiement</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($pieces)
                        @foreach($pieces as $piece)
                        <tr>
                            <td>{{ (new \Carbon\Carbon($piece->creationfacture ?? $piece->creationproforma))->format('d/m/Y') }}</td>
                            <td><a href="{{ route('facturation.details',['refrence' => $piece->referenceproforma]) }}">{{ $piece->referencefacture }}</a></td>
                            <td><a href="{{ route('facturation.details',['refrence' => $piece->referenceproforma]) }}">{{ $piece->referenceproforma }}</a></td>
                            <td>{{ $piece->referencebl }}</td>
                            <td>{{ $piece->objet }}</td>
                            <td>{{ number_format($piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva), 0, '', ' ') }}</td>
                            @php $rap += $piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva); @endphp
                            <td>{{ \App\Statut::getStatut($piece->etat) }}</td>
                            <td title="{{ $piece->remarquepaiement }}">{{ $piece->moyenPaiement ? $piece->moyenPaiement->libelle : null }}</td>
                            <td>{{ $piece->datereglement ? (new \Carbon\Carbon($piece->datereglement))->format('d/m/Y') : null }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="10"><h5>Total : {{ number_format($rap, 0, '', ' ') }} F CFA</h5></td>
                        </tr>
                        @else
                            <td colspan="10">
                                <h3>Aucune pièce comptable n'a été passée avec ce partenaire !</h3>
                            </td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection