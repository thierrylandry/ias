@extends('layouts.main')
@section("link")
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-10">
                        <div class="row">
                            <form method="get">
                            <div class="col-md-2 col-sm-6">
                                <b>Début</b>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                    <div class="form-line">
                                        <input name="debut" type="text" class="form-control datepicker" placeholder="Ex: 30/07/2016" value="{{ $debut->format("d/m/Y") }}">
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
                                        <input name="fin" type="text" class="form-control datepicker" placeholder="Ex: 30/07/2016" value="{{ $fin->format("d/m/Y") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <b>Véhicules</b>
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="vehicule" name="vehicule" data-live-search="true" required>
                                        <option value="#">Tous les véhicules</option>
                                        @foreach($vehicules as $vehicule)
                                            <option value="{{ $vehicule->id }}">{{ $vehicule->marque }} {{ $vehicule->typecommercial }} ({{ $vehicule->immatriculation }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <b>Réparations</b>
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="type" name="type" data-live-search="true" required>
                                        <option value="#">Toutes les interventions</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="input-group">
                                <button class="btn waves-effect bg-blue-grey">
                                    <i class="material-icons">search</i>
                                    <span>Recherche</span>
                                </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="align-right">
                            <a href="{{ route("reparation.nouvelle") }}" class="btn bg-blue waves-effect">Nouvelle réparation</a>
                        </div>
                    </div>
                    <br class="clearfix"/>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-green">
                            <th width="7%"></th>
                            <th width="15%">Véhicule</th>
                            <th width="10%">Début</th>
                            <th width="10%">Fin</th>
                            <th width="7%">Nbre jours</th>
                            <th width="10%">Coût</th>
                            <th>Détails</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($interventions as $intervention)
                        <tr>
                            <td></td>
                            <td>
                                <a href="{{ route('vehicule.details',["immatriculation" => $intervention->vehicule->immatriculation]) }}">
                                    {{ $intervention->vehicule->marque }} {{ $intervention->vehicule->typecommercial }} ({{ $intervention->vehicule->immatriculation }})
                                </a>
                            </td>
                            <td>{{ (new \Carbon\Carbon($intervention->debut))->format("d/m/Y") }}</td>
                            <td>{{ (new \Carbon\Carbon($intervention->fin))->format("d/m/Y") }}</td>
                            <td>{{ (new \Carbon\Carbon($intervention->fin))->diffInDays(new \Carbon\Carbon($intervention->debut)) }}</td>
                            <td class="amount">{{ number_format($intervention->cout, 0, ",", " ") }}</td>
                            <td>{{ $intervention->details }}</td>
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
@section("script")
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>

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