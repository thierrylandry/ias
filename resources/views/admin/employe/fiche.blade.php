@extends("layouts.main")

@section("content")
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3>{{ $employe->nom }} {{ $employe->prenoms }} ({{ $employe->matricule }})</h3>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-3 col-sm-5 col-xs-12">
                            <img class="right" src="{{ asset(\Illuminate\Support\Facades\Storage::url($employe->photo)) }}">
                        </div>
                        <div class="col-md-9 col-sm-7 col-xs-12">
                            <p></p>
                            <p><i class="material-icons">call</i> <span class="relative-8">{{ $employe->contact }}</span></p>
                            <p><i class="material-icons">featured_play_list</i> <span class="relative-8">{{ $employe->pieceidentite }}</span></p>
                            <p><i class="material-icons">cake</i> <span class="relative-8">{{ (new \Carbon\Carbon($employe->datenaissance))->format('d/m/Y') }}</span></p>
                        </div>
                    </div>
                    <hr/>
                    <div class="col-md-12">
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">business</i> <span class="relative-8">{{ $employe->service->libelle }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">file_download</i> <span class="relative-8">{{  (new \Carbon\Carbon($employe->dateembauche))->format('d/m/Y') }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">monetization_on</i> <span class="relative-8 devise">{{ number_format($employe->basesalaire, 0, "."," ") }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            @if($employe->datesortie)
                            <i class="material-icons">file_upload</i> <span class="relative-8">{{ $employe->datesortie }}</span>
                            @endif
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">RIB</i> <span class="relative-8 devise">{{ $employe->rib }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">CNPS</i> <span class="relative-8 devise">{{ $employe->cnps }}</span>
                        </div>
                    </div>

                    <br class="clearfix"/>
                </div>
            </div>
            @if($employe->chauffeur)
            <div class="card">
                <div class="header">
                    <h3>Missions</h3>
                </div>
                <div class="body">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-blue-grey">
                            <th>REFERENCE</th>
                            <th>DATES</th>
                            <th>DESTINATION</th>
                            <th>VEHICULE</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($missions as $mission)
                        <tr>
                            <td><a href="{{ route("mission.details", ["reference" => $mission->code]) }}">{{ $mission->code }}</a></td>
                            <td>{{ (new \Carbon\Carbon($mission->debuteffectif))->format('d/m/Y') }} au {{ (new \Carbon\Carbon($mission->fineffective))->format('d/m/Y') }} ({{ (new \Carbon\Carbon($mission->debuteffectif))->diffInDays((new \Carbon\Carbon($mission->fineffective))) }} jour(s))</td>
                            <td>{{ $mission->destination }}</td>
                            <td>{{ $mission->vehicule->immatriculation }} - {{ $mission->vehicule->marque }} {{ $mission->vehicule->typecommercial }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="card">
                <div class="header">
                    <h3>Salaires</h3>
                </div>
                <div class="body">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-blue-grey">
                            <th>ANNEE</th>
                            <th>MOIS</th>
                            <th>SALAIRE NET</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($bulletins as $bulletin)
                            <tr>
                                <td>{{ $bulletin->annee }}</td>
                                <td>{{ \App\Http\Controllers\RH\Tools::getMonthsById($bulletin->mois) }}</td>
                                <td>{{ number_format($bulletin->nap, 0, ".", " ") }} F CFA</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection