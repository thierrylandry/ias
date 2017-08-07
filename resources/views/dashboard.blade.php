@extends("layouts.main")

@section("title")Tableau de bord @endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Tableau de bord</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">NEW TASKS</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">NEW TICKETS</div>
                    <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">NEW COMMENTS</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">NEW VISITORS</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    <!-- CPU Usage -->
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-blue-grey card-image">
                    <h2 class="card-title">
                        Véhicules & Missions<small> </small>
                    </h2>
                    <img src="{{ config('app.url') }}images/ias/car.png" style="height: 170px"/>
                </div>
                <div class="body">
                    <div class="list-group">
                        <a href="javascript:void(0);" class="list-group-item">
                            <span class="badge bg-orange">45</span>
                            Véhicule qui requiert votre attention
                        </a>
                        <a href="javascript:void(0);" class="list-group-item">
                            <span class="badge bg-orange">2545 HE 01</span>
                            La visite de ce véhicule est périmée
                        </a>
                    </div>
                    <a class="btn bg-blue-grey waves-effect">Voir plus</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-blue-grey card-image">
                    <h2 class="card-title">
                        Clients et fournisseurs <small> </small>
                    </h2>
                    <img src="{{ config('app.url') }}images/ias/partenaire.png" style="width: 170px" />
                </div>
                <div class="body">
                    <div class="list-group">
                        <a href="javascript:void(0);" class="list-group-item">
                            <span class="badge bg-orange">45</span>
                            Véhicule qui requiert votre attention
                        </a>
                        <a href="javascript:void(0);" class="list-group-item">
                            <span class="badge bg-orange">2545 HE 01</span>
                            La visite de ce véhicule est périmée
                        </a>
                    </div>
                    <a class="btn bg-blue-grey waves-effect">Voir plus</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-blue-grey card-image">
                    <h2 class="card-title">
                        Chauffeurs & personnel <small> </small>
                    </h2>
                    <img src="{{ config('app.url') }}images/ias/personnel.jpg" style="width: 170px" />
                </div>
                <div class="body">
                    <div class="list-group">
                        <a href="javascript:void(0);" class="list-group-item">
                            <span class="badge bg-orange">45</span>
                            Véhicule qui requiert votre attention
                        </a>
                        <a href="javascript:void(0);" class="list-group-item">
                            <span class="badge bg-orange">2545 HE 01</span>
                            La visite de ce véhicule est périmée
                        </a>
                    </div>
                    <a class="btn bg-blue-grey waves-effect">Voir plus</a>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CPU Usage -->
    <div class="row clearfix">

    </div>

    <div class="row clearfix">

    </div>
</div>
@endsection