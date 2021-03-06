@extends("layouts.main")

@section("title")Tableau de bord @endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Tableau de bord</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix" style="display: none;">
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
                    <a class="btn bg-blue-grey waves-effect" href="{{ route('vehicule.liste') }}"><img src="{{ asset('images/ias/car.png') }}" style="height: 170px"/></a>
                </div>
                <div class="body" id="vehicule_state">
                    <div class="preloader pl-size-l">
                        <div class="spinner-layer pl-orange">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-blue-grey card-image">
                    <h2 class="card-title">
                        Clients et fournisseurs <small> </small>
                    </h2>
                    <a class="btn bg-blue-grey waves-effect"><img src="{{ asset('images/ias/partenaire.png') }}" style="width: 170px" /></a>
                </div>
                <div class="body" id="partnaire_state">
                    <div class="preloader pl-size-l">
                        <div class="spinner-layer pl-light-blue">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-blue-grey card-image">
                    <h2 class="card-title">
                        Chauffeurs & personnel <small> </small>
                    </h2>
                    <a class="btn bg-blue-grey waves-effect"><img src="{{ asset('images/ias/personnel.jpg') }}" style="width: 170px" /></a>
                </div>
                <div class="body" id="employe_state">
                    <div class="preloader pl-size-l">
                        <div class="spinner-layer pl-teal">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CPU Usage -->
    <div class="row clearfix">

    </div>

    <div class="row clearfix">

    </div>

    <!--
    <div class="fadeOut">
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
    </div>
    -->
</div>
@endsection
@section("script")
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<!-- SweetAlert Plugin Js -->
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
    var URL_CHECKER = '{{ route("rappel") }}';
    var dataObject = null;

    $(document).ready(function () {
        $.ajax({
            url: URL_CHECKER,
            dataType: "json",
            method : "get",
            error : function (xhr, statut) {
                swal({
                    icon : "error",
                    title : "Statut des vérifications",
                    text:"Impossible de vérifier le status des missions, visites et assurance des véhicules."
                });
            },
            complete : function (xhr, statut) {
                console.log(xhr.responseJSON);
                dataObject = xhr.responseJSON;

                processMission(dataObject.missions);
                processChauffeur(dataObject.chauffeurs);
                processPartenaire({});
            }
        });
    });
    
    function processMission(missions) {
        var extrem = "";
        var $target = $("#vehicule_state");

        var lines = "";

        for(var i=0; i<missions.length; i++){
            //console.log(missions[i]);
            var tmp="La mission du "+
                missions[i].immatriculation+", chauffeur "+missions[i].nom+" "+missions[i].prenoms+" "+
                " à "+missions[i].destination+" prévu pour le "+
                moment(missions[i].debuteffectif).format("DD/MM/YYYY")+
                (missions[i].delais > 0 ? " est dans":" est passée")+
                " de "+ Math.abs(missions[i].delais)+ " jour(s)" ;

            lines += getLineTemplate(tmp);
        }

        $target.html("");
        $target.append(getBaseTemplate(lines));
    }

    function processVehicules(vehicules) {
        var extrem = "";
        var $target = $("#vehicule_state");

        var lines = "";

        for(var i=0; i<missions.length; i++){
            //console.log(missions[i]);
            var tmp="La mission du "+
                missions[i].immatriculation+", chauffeur "+missions[i].nom+" "+missions[i].prenoms+" "+
                " à "+missions[i].destination+" prévu pour le "+
                moment(missions[i].debuteffectif).format("DD/MM/YYYY")+
                (missions[i].delais > 0 ? " est dans":" est passée")+
                " de "+ Math.abs(missions[i].delais)+ " jour(s)" ;

            lines += getLineTemplate(tmp);
        }

        $target.html("");
        $target.append(getBaseTemplate(lines));
    }

    function processChauffeur(chauffeurs) {
        var extrem = "";
        var $target = $("#employe_state");

        var lines = "";

        for(var i=0; i<chauffeurs.length; i++){
            //console.log(missions[i]);
            var tmp="La permis du chauffeur "+
                chauffeurs[i].nom+" "+chauffeurs[i].prenoms+
                (chauffeurs[i].expiration_c > 0 ? " est arrivé ":" arrive ")+
                " à expiration dans "+ Math.abs(chauffeurs[i].delai_permis_c)+ " jour(s)" ;

            lines += getLineTemplate(tmp);
        }

        $target.html("");
        $target.append(getBaseTemplate(lines));
    }

    function processPartenaire(partenaires) {
        var extrem = "";
        var $target = $("#partnaire_state");
        var lines = "";

        //

        $target.html("");
        $target.append(getBaseTemplate(lines));
    }

    function getLineTemplate(text) {
        return '<a href="javascript:void(0);" class="list-group-item list-group-bg-red">' + text +'</a>';
    }

    function getBaseTemplate(lines) {
        return ""+
        '<div class="fadeOut">' +
            '<div class="list-group">' +
            lines+
            '</div>' +
        '</div>';
    }
</script>
@endsection