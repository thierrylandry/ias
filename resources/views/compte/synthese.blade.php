@extends('layouts.main')
@section("link")
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h3>Synthèse des sous comptes</h3>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="body table-responsive">
                            <table class="table table-bordered table-hover ">
                                <thead>
                                <tr class="bg-green">
                                    <th width="3%"></th>
                                    <th>Date écriture</th>
                                    <th>Date action</th>
                                    <th>Objet</th>
                                    <th>Montant</th>
                                    <th>Balance</th>
                                    <th>Opérateur</th>
                                </tr>
                                </thead>
                                <tbody class="table-hover">
                                @foreach($lignes as $ligne)
                                    <tr>
                                        <td>
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group btn-group-xs" role="group">
                                                    <a class="btn bg-orange waves-effect" href="javascript:void(0);" onclick="edit('{{ $ligne->id }}','{{ (new \Carbon\Carbon($ligne->dateecriture))->format('d/m/Y') }}','{{ $ligne->objet }}');" title="Modifier"><i class="material-icons">edit</i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ (new \Carbon\Carbon($ligne->dateaction))->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ (new \Carbon\Carbon($ligne->dateoperation))->format('d/m/Y') }}</td>
                                        <td>{{ $ligne->objet }} (Compte {{ $ligne->compte->libelle}})</td>
                                        <td><a title="{{ $ligne->observation }}">{{ number_format($ligne->montant, 0, ',',' ') }}</a></td>
                                        <td>{{ number_format($ligne->balance, 0, ',',' ') }}</td>
                                        <td>{{ $ligne->utilisateur->employe->nom }} {{ $ligne->utilisateur->employe->prenoms }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $lignes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection