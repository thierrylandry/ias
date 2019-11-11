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
                <h2>Modification mission #{{ $mission->code }}</h2>
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
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Code de la mission" value="{{ old('code',$mission->code) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="client">Client</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="client" name="client" data-live-search="true" required>
                                    @foreach($partenaires as $partenaire)
                                    <option value="{{ $partenaire->id }}" @if($partenaire->id == old("client",$mission->client)) selected @endif>{{ $partenaire->raisonsociale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="montantjour">Tarif journalier</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" required name="montantjour" id="montantjour" class="form-control" placeholder="Montant par jour" value="{{ old('montantjour',$mission->montantjour) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="totalperdiem">Montant total HT</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" disabled name="montantht" id="montantht" class="form-control" placeholder="Montant HT" value="0">
                                </div>
                                <span class="input-group-addon">F CFA</span>
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
                                    <input type="text" required name="debuteffectif" id="debuteffectif" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('debuteffectif',(new \Carbon\Carbon($mission->debuteffectif))->format("d/m/Y"))}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="finprogramme">Fin de location</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="fineffective" id="fineffective" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('fineffective',(new \Carbon\Carbon($mission->fineffective))->format("d/m/Y")) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="dureeprogramme">Durée de location</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" disabled name="dureeprogramme" id="dureeprogramme" class="form-control" placeholder="" value="{{old('dureeprogramme')}}">
                                </div>
                                <span class="input-group-addon">jour(s)</span>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="destination">Destination</label>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="destination" id="destination" class="form-control" data-role="tagsinput" value="{{old("destination",$mission->destination)}}"/>
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
                                <select type="text" name="chauffeur_id" id="chauffeur_id" class="form-control input-field" required>
                                    <option value="-1">Aucun chauffeur</option>
                                    @foreach($chauffeurs as $chauffeur)
                                        <option value="{{ $chauffeur->employe_id }}" @if(old('chauffeur_id',$mission->employe_id) == $chauffeur->id) selected @endif>{{ $chauffeur->employe->nom }} {{ $chauffeur->employe->prenoms }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="vehicule_id">Véhicule</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select type="text" name="vehicule_id" id="vehicule_id" class="form-control input-field" required>
                                    <option value="-1">Véhicule du sous-traitant</option>
                                    @foreach($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}" @if(old('vehicule_id',$mission->vehicule_id) == $vehicule->id) selected @endif>{{ $vehicule->marque }} {{ $vehicule->typecommercial }} ({{ $vehicule->immatriculation }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" col-md-offset-6 col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="immat_soustraitance">Mission sous-traitée</label>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                            <div class="switch">
                                <label><input type="checkbox" name="soustraite" value="1" id="soustraite" @if(old("soustraite", $mission->soustraite)) checked @endif><span class="lever switch-col-light-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="immat_soustraitance" id="immat_soustraitance" class="form-control" placeholder="Détails véhicule de sous-traitance" value="{{ old('immat_soustraitance', $mission->immat_soustraitance) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="perdiem">Per diem</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="number" required name="perdiem" id="perdiem" class="form-control" placeholder="Per diem" value="{{ old('perdiem',$mission->perdiem) }}">
                                </div>
                                <span class="input-group-addon">F CFA</span>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="totalperdiem">Total per diem</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" disabled name="totalperdiem" id="totalperdiem" class="form-control" placeholder="" value="{{old('totalperdiem')}}">
                                </div>
                                <span class="input-group-addon">F CFA</span>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="observation">Observations</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="observation" id="observation" class="form-control" placeholder="Observations de la mission" value="">{{ old('observation',$mission->observation) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn bg-green m-t-15 waves-effect">Modifier</button>
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
        calculDureeMission();
        calculTotalPerDiem();
        calculMontantHT();
    });
</script>

<script type="application/javascript">

    var txtdebut = document.getElementById('debuteffectif');
    var txtfin = document.getElementById('fineffective');
    var txtperdiem = document.getElementById('perdiem');
    var txtmontant = document.getElementById('montantjour');

    function calculDureeMission()
    {
        var duree;
        debut = moment(txtdebut.value, 'DD/MM/YYYY', true);
        fin = moment(txtfin.value, 'DD/MM/YYYY', true);
        duree = moment.duration(fin.diff(debut)).asDays()+1;

        if( isNaN(duree) ){ duree = 0; }

        document.getElementById('dureeprogramme').value = duree;
    }

    function calculTotalPerDiem()
    {
        montant = document.getElementById('perdiem').value;
        document.getElementById('totalperdiem').value = montant * document.getElementById('dureeprogramme').value;
    }

    function calculMontantHT()
    {
        mtnt = document.getElementById('montantjour').value;
        document.getElementById('montantht').value = mtnt * document.getElementById('dureeprogramme').value;
    }

    txtperdiem.addEventListener('change',function (e) {calculTotalPerDiem()});

    txtmontant.addEventListener('change',function (e) {calculMontantHT()});
    
    $(document).ready(function (e) {
        calculDureeMission();
        calculTotalPerDiem();
        calculMontantHT();
    });

</script>
@endsection