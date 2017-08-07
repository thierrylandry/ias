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
                <h2>
                    Nouveau chauffeur
                </h2>
            </div>
            <div class="body">
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="employe_id">Employé</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select type="text" name="employe_id" id="employe_id" class="form-control input-field">
                                    @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" @if(old('employe_id') == $employe->id) selected @endif>{{ $employe->nom }} {{ $employe->prenoms }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="permis">Permis</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="permis" id="permis" class="form-control" placeholder="N° de permis" value="{{ old('permis') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="expiration_c">Exp. catégorie C</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="expiration_c" id="expiration_c" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('expiration_c')}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="expiration_d">Exp. catégorie D</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="expiration_d" id="expiration_d" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('expiration_d') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="expiration_e">Exp. catégorie  E</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="expiration_e" id="expiration_e" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('expiration_e')}}">
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
@endsection

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