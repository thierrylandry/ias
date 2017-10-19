@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-4">
                        <h2>
                            Liste des véhicules
                            <small>Liste de tous les véhicules IAS</small>
                        </h2>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="align-right">
                            <a href="{{ route('vehicule.nouveau') }}" class="btn bg-blue waves-effect">Ajouter un véhicule</a>
                        </div>
                    </div>
                    <br class="clearfix"/>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-green">
                            <th width="7.5%"></th>
                            <th width="10%">IMMATRICULATION</th>
                            <th>MARQUE</th>
                            <th>MODELE</th>
                            <th>GENRE</th>
                            <th>EXP VISITE</th>
                            <th>EXP ASSUR</th>
                            <th>COULEUR</th>
                            <th width="4%">PLACES</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($vehicules as $vehicule)
                        <tr>
                            <th scope="row">
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group btn-group-xs" role="group">
                                        <a class="btn bg-blue-grey waves-effect" href="{{ route("mission.nouvelle",[ 'vehicule' => $vehicule->immatriculation ]) }}" title="Démarrer une mission"><i class="material-icons">directions_car</i></a>
                                        <a class="btn bg-green waves-effect" href="#" title="Modifier le véhicule"><i class="material-icons">edit</i></a>
                                        <a class="btn bg-orange waves-effect" href="{{ route("vehicule.details", ["immatriculation" => $vehicule->immatriculation]) }}" title="Consulter le rapport du véhicule"><i class="material-icons">insert_drive_file</i></a>
                                        <a class="btn bg-light-blue waves-effect" href="{{ route("reparation.nouvelle", ["vehicule" => $vehicule->immatriculation ]) }}" title="Démarrer une intervention"><i class="material-icons">settings</i></a>
                                    </div>
                                </div>
                            </th>
                            <th valign="center">{{ $vehicule->immatriculation }}</th>
                            <td>{{ $vehicule->marque }}</td>
                            <td>{{ $vehicule->typecommercial }}</td>
                            <td>{{ $vehicule->genre->libelle }}</td>
                            <td>{{ (new \Carbon\Carbon($vehicule->visite))->format('d/m/Y') }}</td>
                            <td>{{ (new \Carbon\Carbon($vehicule->assurance))->format('d/m/Y') }}</td>
                            <td>{{ $vehicule->couleur }}</td>
                            <td>{{ $vehicule->nbreplace }}</td>
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