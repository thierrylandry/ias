@extends('layouts.main')

@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Modifier mission PL #{{ $mission->code }}</h2>
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
                                        <input type="text" disabled name="code" id="code" class="form-control" placeholder="Code de la mission" value="{{ old('code', $mission->code) }}">
                                        <input type="hidden" name="code" value="{{ $mission->code }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="partenaire_id">Client</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="partenaire_id" name="partenaire_id" data-live-search="true" required>
                                        @foreach($partenaires as $partenaire)
                                            <option value="{{ $partenaire->id }}" @if(old('partenaire_id', $mission->partenaire_id) == $partenaire->id) selected @endif>{{ $partenaire->raisonsociale }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="datedebut">Début de location</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="datedebut" id="datedebut" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('datedebut',(new\Carbon\Carbon($mission->datedebut))->format("d/m/Y"))}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="destination">Destination</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="destination" id="destination" class="form-control" data-role="tagsinput" value="{{old("destination", $mission->destination)}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="vehicule_id">Véhicule</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select type="text" name="vehicule_id" id="vehicule_id" class="form-control input-field" data-live-search="true" required>
                                        <!-- <option value="-1">Véhicule du sous-traitant</option> -->
                                        @foreach($vehicules as $vehicule)
                                            <option data-chauffeur="{{ $vehicule->chauffeur_id ?? 0 }}" value="{{ $vehicule->id }}" @if(old('vehicule_id', $mission->vehicule_id) == $vehicule->id) selected @endif>{{ $vehicule->marque }} {{ $vehicule->typecommercial }} ({{ $vehicule->immatriculation }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="chauffeur_id">Chauffeur</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select type="text" name="chauffeur_id" id="chauffeur_id" class="form-control input-field" data-live-search="true" required>
                                        <!-- <option value="-1">Aucun chauffeur</option> -->
                                        @foreach($chauffeurs as $chauffeur)
                                            <option id="chauff_{{$chauffeur->employe_id}}" value="{{ $chauffeur->employe_id }}" @if(old('chauffeur_id', $mission->chauffeur_id) == $chauffeur->employe_id) selected @endif>{{ $chauffeur->employe->nom }} {{ $chauffeur->employe->prenoms }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="kilometrage">Kilometrage</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="number" placeholder="Distance en kilomètre" required name="kilometrage" id="kilometrage" class="form-control" value="{{ old("kilometrage", $mission->kilometrage) }}"/>
                                    </div>
                                    <span class="input-group-addon">Km</span>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="carburant">Carburant</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="number" placeholder="Montant du carburant" required name="carburant" id="carburant" class="form-control"  value="{{ old("carburant", $mission->carburant) }}"/>
                                    </div>
                                    <span class="input-group-addon">F CFA</span>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                                <a href="javascript:history.back();" class="btn btn-default m-t-15 waves-effect">Annuler</a>
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
    <script type="text/javascript"  src="{{ asset('plugins/momentjs/moment-with-locales.min.js') }}"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>


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
        }).on('change', function(e, date){
            //
        });
    </script>
@endsection()