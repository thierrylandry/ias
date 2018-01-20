@extends("layouts.main")
@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection

@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Nouvelle facture fournisseur</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form class="form-line" action="" method="post">
                        {{ csrf_field() }}

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="datepiece">Date facture</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="datepiece" id="datepiece" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('datepiece',\Carbon\Carbon::now()->format("d/m/Y")) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="montant">Fournisseur</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control selectpicker" id="partenaire_id" name="partenaire_id" data-live-search="true" required>
                                    @foreach($partenaires as $partenaire)
                                        <option value="{{ $partenaire->id }}" @if(old('partenaire_id') == $partenaire->id)  selected @endif >{{ $partenaire->raisonsociale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="objet">Reférence</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="reference" id="reference" class="form-control" placeholder="N° de la facture" value="{{ old('reference') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="objet">Objet</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="objet" id="objet" class="form-control" placeholder="Objet de la facture" value="{{ old('objet') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="montant">Montant TTC</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="number" required name="montant" id="montant" class="form-control" placeholder="Montant de la facture" value="{{ old('montant') }}">
                                    </div>
                                    <span class="input-group-addon">F CFA</span>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="observation">Observation</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea maxlength="255" name="observation" id="observation" class="form-control" placeholder="Observations">{{ old('montant') }}</textarea>
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
</div>
@endsection

@section('script')
    <!-- Moment Plugin Js -->
    <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('plugins/momentjs/moment-with-locales.min.js') }}"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>
    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" >
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