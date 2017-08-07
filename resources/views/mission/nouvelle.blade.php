@extends('layouts.main')

@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

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
                            <label for="code">Client</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select class="form-control selectpicker show-tick" data-live-search="true">
                                    <option>Hot Dog, Fries and a Soda</option>
                                    <option>Burger, Shake and a Smile</option>
                                    <option>Sugar, Spice and all things nice</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="montantjour">Montant/jour</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="montantjour" id="montantjour" class="form-control" placeholder="Montant par jour" value="{{ old('montantjour') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="totalperdiem">Montant total HT</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" disabled name="montantht" id="montantht" class="form-control" placeholder="Montant HT" value="{{ old('montantht') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

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
                            <label for="dureeprogramme">Durée de location</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" disabled name="dureeprogramme" id="dureeprogramme" class="form-control" placeholder="" value="{{old('dureeprogramme')}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="destinations">Destination</label>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="destination" id="destination" class="form-control" data-role="tagsinput"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

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
                            <label for="perdiem">Per diem</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="perdiem" id="perdiem" class="form-control" placeholder="Per diem" value="{{ old('perdiem') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="totalperdiem">Total per diem</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" disabled name="totalperdiem" id="totalperdiem" class="form-control" placeholder="" value="{{old('totalperdiem')}}">
                                </div>
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
        calculDureeMission();
        calculTotalPerdiem();
        calculMontantHT();
    });
</script>

<script type="application/javascript">

    var txtdebut = document.getElementById('debutprogramme');
    var txtfin = document.getElementById('finprogramme');
    var txtperdiem = document.getElementById('perdiem');
    var txtmontant = document.getElementById('montantjour');

    function calculDureeMission()
    {
        var duree;
        debut = moment(txtdebut.value, 'DD/MM/YYYY', true);
        fin = moment(txtfin.value, 'DD/MM/YYYY', true);
        duree = moment.duration(fin.diff(debut)).asDays();
        document.getElementById('dureeprogramme').value = duree;
    }

    function calculTotalPerdiem()
    {
        montant = document.getElementById('perdiem').value;
        document.getElementById('totalperdiem').value = montant * document.getElementById('dureeprogramme').value;
    }

    function calculMontantHT()
    {
        mtnt = document.getElementById('montantjour').value;
        document.getElementById('montantht').value = mtnt * document.getElementById('dureeprogramme').value;
    }

    txtperdiem.addEventListener('change',function (e) {calculTotalPerdiem()});

    txtmontant.addEventListener('change',function (e) {calculMontantHT()});

</script>
@endsection