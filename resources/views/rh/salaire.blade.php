@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Salaire mensuel
                </h2>
            </div>
            <div class="body">
                <form class="form-horizontal" method="post" >
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="annee">Année</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select name="annee" id="annee" class="form-control input-field">
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee }}" @if(old('annee', \Carbon\Carbon::now()->year) == $annee) selected @endif> {{ $annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="mois">Mois</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select name="mois" id="mois" class="form-control input-field">
                                    @foreach($months as $mois)
                                        <option value="{{ $mois->id }}" @if(old('mois', \Carbon\Carbon::now()->month) == $mois->id) selected @endif> {{ $mois->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn btn-lg bg-green m-t-15 waves-effect">Valider</button>
                            <button type="reset" class="btn btn-lg btn-default m-t-15 waves-effect">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection