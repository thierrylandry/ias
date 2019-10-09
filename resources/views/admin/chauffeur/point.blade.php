@extends("layouts.main")
@php
$totalPaye = 0;
$totalApayer = 0;
$totalJours = 0;
@endphp
@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-8">
                        <h2>Situation chauffeur : {{ $chauffeur->employe->nom }} {{ $chauffeur->employe->prenoms }}</h2>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="align-right">
                            <!-- <a href="{{ route('partenaire.nouveau') }}" class="btn bg-blue waves-effect">Ajouter un partenaire</a> -->
                        </div>
                    </div>
                    <br class="clearfix"/>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-green">
                            <td colspan="2">Mission</td>
                            <td rowspan="2">Client</td>
                            <td rowspan="2">Destination</td>
                            <td rowspan="2">Véhicule</td>
                            <td rowspan="2">Durée en jours</td>
                            <td rowspan="2">Total perdiem</td>
                            <td colspan="2">Versement</td>
                            <td rowspan="2">Reste à payer</td>
                        </tr>
                        <tr class="bg-green">
                            <td>Début</td>
                            <td>Fin</td>
                            <td>Date</td>
                            <td>Montant</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if($missions->count())
                        @foreach($missions as $mission)
                        <tr>
                            <td>{{ (new \Carbon\Carbon($mission->debuteffectif))->format("d/m/Y") }}</td>
                            <td>{{ (new \Carbon\Carbon($mission->fineffective))->format("d/m/Y") }}</td>
                            <td>{{ $mission->clientPartenaire->raisonsociale }}</td>
                            <td>{{ $mission->destination }}</td>
                            <td>{{ $mission->vehicule->immatriculation }}</td>
                            <td class="text-center">{{ $mission->getDuree() }}</td>
                            <td class="amount">{{ number_format($mission->getDuree() * $mission->perdiem,0,","," ") }}</td>

                            <td>
                                <ul>
                                @foreach($mission->versements as $versement)
                                    <li>{{ (new \Carbon\Carbon($versement->dateversement))->format("d/m/Y à H:i") }}</li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($mission->versements as $versement)
                                    <li>
                                        <a title="{{ $versement->commentaires }}" href="javascript:void(0);">
                                            {{ number_format($versement->montant,0,","," ") }} ({{ $versement->moyenreglement->libelle }})
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                            <td class="amount">
                                {{ number_format(
                                ($mission->getDuree() * $mission->perdiem) - $mission->versements->sum(function ($versement){
                                    return $versement->montant;
                                }),0,","," ")
                                }}
                            </td>
                            @php
                                $totalPaye += $mission->versements->sum(function ($versement){
                                    return $versement->montant;
                                });
                                $totalApayer += $mission->getDuree() * $mission->perdiem;
                                $totalJours += $mission->getDuree() ;
                            @endphp
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr class="bg-teal">
                            <td colspan="5">TOTAL</td>
                            <td class="text-center">{{ $totalJours }}</td>
                            <td class="amount devise">{{ number_format($totalApayer,0,","," ") }}</td>
                            <td></td>
                            <td class="amount devise">{{ number_format($totalPaye,0,","," ") }}</td>
                            <td class="amount devise">{{ number_format($totalApayer - $totalPaye,0,","," ") }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection("")