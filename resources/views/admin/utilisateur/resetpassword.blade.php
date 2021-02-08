@extends('layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Nouvel utilisateur
                    </h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="employe_id">Employés</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select type="text" name="employe_id" id="employe_id" class="form-control input-field">
                                        @foreach($employes as $employe)
                                            <option value="{{ $employe->id }}" @if(old('employe_id') == $employe->id || $employe->matricule == request()->query("u")) selected @endif>{{ $employe->nom }} {{ $employe->prenoms }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password">Mot de passe *</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" required name="password" id="password" class="form-control" placeholder="Mot de passe" value="{{ old('password') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password_confirmation">Confirmation *</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" required name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe" value="{{ old('password') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Réinitialiser</button>
                                <a href="javascript:history.back();" class="btn btn-default m-t-15 waves-effect">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection