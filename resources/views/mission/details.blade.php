@extends("layouts.main")
@section("content")
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-green">
                    <h2>Détails de misssion #{{ $mission->code }}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route("mission.modifier", ["reference" => $mission->code]) }}">Modifier la mission</a></li>
                                @if($mission->pieceComptable)
                                <li><a href="{{ route("facturation.details", ["reference" => $mission->pieceComptable->getReference() ]) }}">Consulter la facture</a></li>
                                @endif
                                @if($mission->status != \App\Statut::MISSION_TERMINEE_SOLDEE)
                                    <li><a class="btn bg-teal waves-effect" href="{{ route("versement.mission.ajouter", ["code"=>$mission->code]) }}" title="Effectuer un versement">Effectuer un versement</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Référence</b>
                            <div class="input-group">
                                <span>{{ $mission->code }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Client</b>
                            <div class="input-group">
                                <span><a href="{{ route('partenaire.client', ['id' => $mission->clientPartenaire->id]) }}">{{ $mission->clientPartenaire->raisonsociale }}</a></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Tarif journalier</b>
                            <div class="input-group">
                                <span class="amount devise">{{ number_format($mission->montantjour, 0, ",", " ") }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Début (programmé)</b>
                            <div class="input-group">
                                <span>{{ (new Carbon\Carbon($mission->debuteffectif))->format("d/m/Y") }} ({{ (new Carbon\Carbon($mission->debutprogramme))->format("d/m/Y") }})</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Fin (programmé)</b>
                            <div class="input-group">
                                <span>{{ (new Carbon\Carbon($mission->fineffective))->format("d/m/Y") }} ({{ (new Carbon\Carbon($mission->finprogramme))->format("d/m/Y") }})</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Durée de mission</b>
                            <div class="input-group">
                                <span class="">{{ (new Carbon\Carbon($mission->fineffective))->diffInDays(new Carbon\Carbon($mission->debuteffectif)) }} jours</span>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Véhicule</b>
                            <div class="input-group">
                                <span><a href="{{ route('vehicule.details', ['immatriculation' => $mission->vehicule->immatriculation]) }}">{{ $mission->vehicule->marque }} {{ $mission->vehicule->typecommercial }}, {{ $mission->vehicule->immatriculation }}</a></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Chauffeur</b>
                            <div class="input-group">
                                <span class=""><a href="{{ route('admin.chauffeur.situation', ['matricule' => $mission->chauffeur->employe->matricule]) }}">{{ $mission->chauffeur->employe->nom }} {{ $mission->chauffeur->employe->prenoms }}</a></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Destination</b>
                            <div class="input-group">
                                <span class="">{{ $mission->destination }}</span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Per diem</b>
                            <div class="input-group">
                                <span class="amount devise">{{ number_format($mission->perdiem, 0, ",", " ") }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Total per diem</b>
                            <div class="input-group">
                                <span class="amount devise">{{ number_format($mission->perdiem * (new Carbon\Carbon($mission->fineffective))->diffInDays(new Carbon\Carbon($mission->debuteffectif)), 0, ",", " ") }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Total mission</b>
                            <div class="input-group">
                                <span class="amount devise">{{ number_format($mission->montantjour * (new Carbon\Carbon($mission->fineffective))->diffInDays(new Carbon\Carbon($mission->debuteffectif)), 0, ",", " ") }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="body">
                    <form method="post" action="">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection