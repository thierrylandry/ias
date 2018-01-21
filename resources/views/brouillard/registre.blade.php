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
                <h3>Brouillard de caisse | solde : <b class="bg-green">{{ number_format($solde, 0,',',' ') }} FCFA </b></h3>
                <hr/>
                <form action="" method="get">
                    <div class="row clearfix">
                        <div class="col-md-2 col-sm-6">
                            <b>Début</b>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                                <div class="form-line">
                                    <input name="debut" type="text" class="form-control datepicker" placeholder="Ex: {{ date('d/m/Y') }}" value="{{ old("debut",(\Carbon\Carbon::now()->firstOfMonth()->format("d/m/Y"))) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <b>Fin</b>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                                <div class="form-line">
                                    <input name="fin" type="text" class="form-control datepicker" placeholder="Ex: {{ date('d/m/Y') }}" value="{{ old("fin",Carbon\Carbon::now()->format("d/m/Y")) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <b>Objet</b>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">message </i>
                            </span>
                                <div class="form-line">
                                    <input name="objet" type="text" class="form-control" placeholder="Justificatif" value="{{ old("objet", request()->query('objet')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <br/>
                            <button class="btn bg-teal waves-button waves-effect" type="submit">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-2 col-sm-6">
                        <button class="btn bg-blue waves-button waves-effect" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i> Nouveau mouvement</button>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="body table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                            <tr class="bg-green">
                                <th width=""></th>
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
                                                <a class="btn bg-orange waves-effect" href="{{ '#' }}" title="Modifier"><i class="material-icons">edit</i></a>
                                                <a class="btn bg-red waves-effect" href="{{ '#' }}" title="Supprimer la ligne"><i class="material-icons">delete</i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ (new \Carbon\Carbon($ligne->dateaction))->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ (new \Carbon\Carbon($ligne->dateecriture))->format('d/m/Y') }}</td>
                                    <td>{{ $ligne->objet }}</td>
                                    <td><a title="{{ $ligne->observation }}">{{ number_format($ligne->montant, 0, ',',' ') }}</a></td>
                                    <td>{{ number_format($ligne->balance, 0, ',',' ') }}</td>
                                    <td>{{ $ligne->utilisateur->nom }} {{ $ligne->utilisateur->prenoms }}</td>
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

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form class="form-line" action="{{ "" }}" method="post">
            <div class="modal-content">
                <div class="modal-header bg-light-green">
                    <h4 class="modal-title" id="defaultModalLabel">Nouveau mouvement de caisse</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="dateecriture">Date</label>
                        </div>
                        <div class="col-md-8 col-xs-12 ">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="dateecriture" id="dateecriture" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('dateecriture',\Carbon\Carbon::now()->format("d/m/Y")) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="sens">Opération</label>
                        </div>
                        <div class="col-md-8 col-xs-12 ">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="sens" name="sens" required>
                                    <option @if(old('sens') == '-1') selected @endif value="-1" >Sortie caisse</option>
                                    <option @if(old('sens') == '1') selected @endif value="1" >Approvisionnement</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="objet">Objet du mouvement</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <input type="text" required name="objet" id="objet" class="form-control" placeholder="Objet du mouvement" value="{{ old('objet') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="montant">Montant</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="number" required name="montant" id="montant" class="form-control" placeholder="Montant du mouvement" value="{{ old('montant') }}">
                                </div>
                                <span class="input-group-addon">F CFA</span>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="observation">Observations</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <textarea maxlength="255" id="observation" name="observation" class="form-control" placeholder="Note sur le mouvement">{{ old('observation') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                            <button type="reset" class="btn btn-default m-t-15 waves-effect">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section("script")
    <!-- Moment Plugin Js -->
    <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('plugins/momentjs/moment-with-locales.min.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>
    <script type="text/javascript">
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: false,
            nowButton: true,
            weekStart: 1,
            time: false,
            lang: 'fr',
            cancelText : 'ANNULER',
            nowText : 'AUJOURD\'HUI'
        });
    </script>
@endsection