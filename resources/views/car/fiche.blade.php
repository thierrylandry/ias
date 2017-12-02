@extends("layouts.main")
@php
    $totalDebit = 0;
    $totalCredit = 0;
@endphp
@section("content")
<div class="container-fluid">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="header">
                <h2>Fiche véhicule : {{ $vehicule->immatriculation }}</h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="bg-teal">
                        <th>Date</th>
                        <th>Opérations</th>
                        <th>Débit</th>
                        <th>Crédit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ (new \Carbon\Carbon($vehicule->dateachat))->format("d/m/Y") }}</td>
                        <td>Achat du véhicule</td>
                        <td class="amount">0</td>
                        <td class="amount">{{ number_format($vehicule->coutachat, 0, ","," " ) }}</td>
                        @php $totalCredit += $vehicule->coutachat @endphp
                    </tr>
                    @foreach($collection as $element)
                    <tr>
                        <td>{{ $element->getDate()->format("d/m/Y") }}</td>
                        <td>{{ $element->getDetails() }}</td>
                        <td class="amount">{{ number_format($element->getDebit(), 0, ","," " )}}</td>
                        <td class="amount">{{ number_format($element->getCredit(), 0, ","," " ) }}</td>
                        @php
                        $totalDebit += $element->getDebit();
                        $totalCredit += $element->getCredit();
                        @endphp
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="bg-light-green">
                        <td colspan="2">Total</td>
                        <td class="amount devise">{{ number_format($totalDebit, 0, ","," " ) }}</td>
                        <td class="amount devise">{{ number_format($totalCredit, 0, ","," " ) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection