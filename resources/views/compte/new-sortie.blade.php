@extends("layouts.main")
@section("link")
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection
@section("content")
    <div class="container-fluid">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h3>Mouvement de sous-compte</h3>
                </div>
                <div class="body">
                    <form class="form-line" action="{{ "" }}" method="post">
                        {{ csrf_field() }}
                        <div class="row clearfix">
                            <div class="col-md-3 col-xs-12 form-control-label">
                                <label for="dateecriture">Date</label>
                            </div>
                            <div class="col-md-8 col-xs-12 ">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="dateoperation" id="dateoperation" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('dateoperation',\Carbon\Carbon::now()->format("d/m/Y")) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-3 col-xs-12 form-control-label">
                                <label for="compte_id">Sous compte</label>
                            </div>
                            <div class="col-md-8 col-xs-12 ">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="compte_id" name="compte_id" required>
                                        @foreach($comptes as $compte)
                                        <option @if(old('compte_id') == $compte->id) selected @endif value="{{ $compte->id }}" >{{ $compte->libelle }}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="text" required name="objet" id="objet" class="form-control" placeholder="Objet du mouvement" value="{{ old('objet', request("mission") ? "Dépense sur mission #".request("mission"): null ) }}">
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
                                        <input type="number" required name="montant" id="montant" class="form-control" placeholder="Montant du mouvement" value="{{ old('montant', request("amount")) }}">
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
                                <button type="reset" data-dismiss="modal" class="btn btn-default m-t-15 waves-effect">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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