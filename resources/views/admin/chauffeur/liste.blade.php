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
                                Liste des chauffeurs
                            </h2>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="align-right">
                                <div class="btn-toolbar">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.chauffeur.ajouter') }}" class="btn bg-orange waves-effect"><i class="material-icons">drive_eta</i> Ajouter un chauffeur </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ '#' }}" class="btn bg-blue waves-effect"><i class="material-icons">person_add</i> Ajouter un employé </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br class="clearfix"/>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="bg-green">
                                <th width="7.5%"></th>
                                <th>Nom & prénoms</th>
                                <th>N° de permis</th>
                                <th>Exp. catégorie C</th>
                                <th>Exp. catégorie D</th>
                                <th>Exp. catégorie E</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chauffeurs as $chauffeur)
                            <tr>
                                <td></td>
                                <td>{{ $chauffeur->employe->nom }} {{ $chauffeur->employe->prenoms }}</td>
                                <td>{{ $chauffeur->permis }}</td>
                                <td>{{ (new \Carbon\Carbon($chauffeur->expiration_c))->format('d/m/Y') }}</td>
                                <td>{{ (new \Carbon\Carbon($chauffeur->expiration_d))->format('d/m/Y') }}</td>
                                <td>{{ (new \Carbon\Carbon($chauffeur->expiration_e))->format('d/m/Y') }}</td>
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