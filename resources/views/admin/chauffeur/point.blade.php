@extends("layouts.main")

@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-4">
                        <h2>
                            Situation chauffeur :
                        </h2>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="align-right">
                            <a href="{{ route('partenaire.nouveau') }}" class="btn bg-blue waves-effect">Ajouter un partenaire</a>
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
                            <td colspan="3">Versement</td>
                            <td rowspan="2">Reste à payer</td>
                        </tr>
                        <tr>
                            <td>Début</td>
                            <td>Fin</td>
                            <td>Date</td>
                            <td>Moyen</td>
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
                            <td>{{ (new \Carbon\Carbon($mission->debuteffectif))->diffInDays(new \Carbon\Carbon($mission->fineffective)) }}</td>
                            <td>{{ (new \Carbon\Carbon($mission->debuteffectif))->diffInDays(new \Carbon\Carbon($mission->fineffective))*$mission->perdiem }}</td>

                            @foreach($mission->versements as $versement)
                            <td>{{ (new \Carbon\Carbon($versement->dateversement))->format("d/m/Y à H:i") }}</td>
                            <td>
                                {{ $versement->moyenreglement->libelle }}
                            </td>
                            <td>
                                <a title="{{ $versement->commentaires }}" href="javascript:void(0);">{{ $versement->montant }}</a>
                            </td>
                            @endforeach
                            <td></td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection("")