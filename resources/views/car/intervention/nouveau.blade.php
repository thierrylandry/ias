@extends("layouts.main")

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
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-12">
                            <h2>Nouvelle intervention</h2>
                        </div>
                        <div class="col-md-offset-3 col-md-2 col-sm-12">
                            <button class="btn bg-blue" data-toggle="modal" data-target="#defaultModal">Nouveau type d'intervention</button>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="code">Véhicule</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="vehicule_id" name="vehicule_id" data-live-search="true" required>
                                        @foreach($vehicules as $vehicule)
                                            <option value="{{ $vehicule->id }}" @if(request()->query("vehicule") == $vehicule->immatriculation) selected @endif>
                                                {{ $vehicule->marque }} {{ $vehicule->typecommercial }} ({{ $vehicule->immatriculation }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="client">Fournisseur</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="partenaire_id" name="partenaire_id" data-live-search="true" required>
                                        <option value="-1">Intervention sans fournisseur</option>
                                        @foreach($fournisseurs as $fournisseur)
                                            <option @if(old("partenaire_id") ==  $fournisseur->id) selected @endif value="{{ $fournisseur->id }}">{{ $fournisseur->raisonsociale }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="client">Intervention</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="typeintervention_id" name="typeintervention_id" data-live-search="true" required>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}" @if($type->id == old('typeintervention_id')) selected @endif>{{ $type->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="cout">Coût</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="number" name="cout" id="cout" class="form-control" value="{{ old('cout', 0) }}">
                                    </div>
                                    <span class="input-group-addon">F CFA</span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="debut">Début d'intervention</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="debut" id="debut" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('debut', \Carbon\Carbon::now()->format("d/m/Y"))}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="fin">Fin d'intervention</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="fin" id="fin" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('fin', \Carbon\Carbon::now()->format("d/m/Y")) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="details">Détails</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control" name="details" id="details" placeholder="Observations et remarques de l'intervention">{{ old('details', null) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                                <a href="javascript:history.back();" class="btn btn-default m-t-15 waves-effect">Annuler</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="form-line" action="{{ route("reparation.type.add") }}" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-light-green">
                        <h4 class="modal-title" id="defaultModalLabel">Ajouter un nouveau type d'intervention</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row clearfix">
                            <div class="col-md-3 col-xs-12 form-control-label">
                                <label for="libelle">Libellés</label>
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <div class="form-group">
                                    <input id="libelle" name="libelle" class="form-control" placeholder="Saisir le nom" type="text" />
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                                <a data-dismiss="modal" class="modal-close btn btn-default m-t-15 waves-effect">Annuler</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>

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
    });
</script>
@endsection