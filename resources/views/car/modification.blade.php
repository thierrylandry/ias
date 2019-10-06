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
                        Modification véhicule {{ $vehicule->immatriculation }}
                    </h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $vehicule->id }}">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="dateachat">Date d'achat</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="dateachat" id="dateachat" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('dateachat',(new \Carbon\Carbon($vehicule->dateachat))->format('d/m/Y'))}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="coutachat">Coût d'achat</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="coutachat" id="coutachat" class="form-control" placeholder="Coût d'achat du véhicule" value="{{ old('coutachat', $vehicule->coutachat) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="genre_id">Genre</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select type="text" name="genre_id" id="genre_id" class="form-control input-field">
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}" @if(old('genre_id', $vehicule->genre_id) == $genre->id) selected @endif> {{ $genre->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="genre_id">Chauffeur</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select type="text" name="chauffeur_id" id="chauffeur_id" class="form-control input-field">
                                        @foreach($chauffeurs as $chauffeur)
                                            <option value="{{ $chauffeur->id }}" @if(old('chauffeur_id') == $vehicule->chauffeur_id) selected @endif> {{ $chauffeur->employe->nom }} {{ $chauffeur->employe->prenoms }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="immatriculation">Immatriculation</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="immatriculation" id="immatriculation" class="form-control" placeholder="Immatriculation du véhicule" value="{{ old('immatriculation', $vehicule->immatriculation) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="cartegrise">Carte grise</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="cartegrise" id="cartegrise" class="form-control" placeholder="N° de carte grise" value="{{ old('cartegrise', $vehicule->cartegrise) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="marque">Marque</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="marque" id="marque" class="form-control" placeholder="Marque du véhicule" value="{{old('marque', $vehicule->marque)}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="typecommercial">Type commercial</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="typecommercial" id="typecommercial" class="form-control" placeholder="Type commercial ou modèle" value="{{ old('typecommercial', $vehicule->typecommercial) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="couleur">Couleur</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="couleur" id="couleur" class="form-control" placeholder="Couleur du véhicule" value="{{old('couleur', $vehicule->couleur)}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="energie">Energie</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="energie" id="energie" class="form-control" placeholder="Energie" value="{{ old('energie', $vehicule->energie) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="nbreplace">Nbre place</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="nbreplace" id="nbreplace" class="form-control" placeholder="Nombre de place" value="{{old('nbreplace', $vehicule->nbreplace)}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="puissancefiscale">Puissance fiscale</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="puissancefiscale" id="puissancefiscale" class="form-control" placeholder="Puissance fiscale" value="{{ old('puissancefiscale', $vehicule->puissancefiscale) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="visite">Fin de visite</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="visite" id="visite" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('visite', (new \Carbon\Carbon($vehicule->visite))->format('d/m/Y'))}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="assurance">Fin de l'assurance</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="assurance" id="assurance" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('assurance', (new \Carbon\Carbon($vehicule->assurance))->format('d/m/Y')) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

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
@endsection

@section('script')
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