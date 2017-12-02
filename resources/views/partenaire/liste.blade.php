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
                            Liste des partenaires
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
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-green">
                            <th width="7.5%"></th>
                            <th>RAISON SOCIALE</th>
                            <th>COMPTE CONTRIBUABLE</th>
                            <th>CONTACT</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($partenaires as $partenaire)
                            <tr>
                                <th scope="row">
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group btn-group-xs" role="group">
                                            <a class="btn bg-blue-grey waves-effect" href="{{ '#' }}" title="Démarrer une mission"><i class="material-icons">directions_car</i></a>
                                            <a class="btn bg-green waves-effect" href="{{ route("partenaire.modifier", ["id" => $partenaire->id]) }}" title="Modifier"><i class="material-icons">edit</i></a>
                                            <a class="btn bg-orange waves-effect" href="#" title="Consulter l'état"><i class="material-icons">insert_drive_file</i></a>
                                        </div>
                                    </div>
                                </th>
                                <th valign="center">{{ $partenaire->raisonsociale }}</th>
                                <td>{{ $partenaire->comptecontribuable }}</td>
                                <td>{{ $partenaire->contactString() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $partenaires->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection