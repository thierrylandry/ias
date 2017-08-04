@extends('layouts.main')

@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Nouvelle mission</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="code">Code de la mission</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Code de la mission" value="{{ old('code') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="vehicule_id">Véhicule</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select type="text" name="vehicule_id" id="vehicule_id" class="form-control input-field">
                                    @foreach($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}" @if(old('vehicule_id') == $vehicule->id) selected @endif>{{ $vehicule->marque }} {{ $vehicule->typecommercial }} ({{ $vehicule->immatriculation }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="debutprogramme">Début de location</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="debutprogramme" id="debutprogramme" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('debutprogramme')}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="finprogramme">Fin de location</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="finprogramme" id="finprogramme" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('finprogramme') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="chauffeur_id">Chauffeur</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select type="text" name="chauffeur_id" id="chauffeur_id" class="form-control input-field">
                                    @foreach($chaufffeurs as $chaufffeur)
                                        <option value="{{ $chaufffeur->employe_id }}" @if(old('vehicule_id') == $chaufffeur->id) selected @endif>{{ $chaufffeur->employe->nom }} {{ $chaufffeur->employe->prenoms }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="perdiem">Perdiem</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="perdiem" id="perdiem" class="form-control" placeholder="Perdiem" value="{{ old('perdiem') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection()

@section('script')
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