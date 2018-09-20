@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Clôturer les salaire du mois de {{ \App\Http\Controllers\RH\SalaireController::getMonthsById($salaire->mois) }} {{ $salaire->annee }}</h2>
            </div>
            <div class="body">
                <form method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box-2 bg-light-blue hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">monetization_on</i>
                            </div>
                            <div class="content">
                                <div class="text">CUMUL</div>
                                <div class="number">{{ number_format($bulletins->somme, 0, ".", " ") }} F CFA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box-2 bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">donut_small</i>
                            </div>
                            <div class="content">
                                <div class="text">POURCENTAGE</div>
                                <div class="number">{{ (100 * $bulletins->total)/$personnel }} %</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box-2 bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">people</i>
                            </div>
                            <div class="content">
                                <div class="text">SALARIES</div>
                                <div class="number">{{ $bulletins->total }}/{{ $personnel }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                        <input type="hidden" name="annee" value="{{ $salaire->annee }}" />
                        <input type="hidden" name="mois" value="{{ $salaire->mois }}" />
                        <input type="hidden" name="total" value="{{ $bulletins->total }}" />
                        <input type="hidden" name="payes" value="{{ $personnel }}" />
                        <button type="submit" class="btn btn-lg bg-green m-t-15 waves-effect">Clôturer</button>
                        <button type="reset" class="btn btn-lg bg-red m-t-15 waves-effect">Annuler</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection