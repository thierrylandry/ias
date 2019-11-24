@extends("layouts.main")
@section('content')
<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-12">
                            <h2>Détails intervention #{{$intervention->id}}</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <span>Véhicule</span><br/>
                                <b>{{ $intervention->vehicule->marque }} {{ $intervention->vehicule->typecommercial }} ({{ $intervention->vehicule->immatriculation }})</b>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <span>Fournisseur</span><br/>
                                @if($intervention->partenaire)
                                    <b>{{ $intervention->partenaire->raisonsociale }}</b>
                                @endif
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <span>Facture</span><br/>
                                @if($intervention->pieceFournisseur)
                                <b><a href="{{ route("partenaire.fournisseur.factures.details",["id"=>$intervention->pieceFournisseur->id]) }}" title="Consulter les détails de la facture">
                                    {{ $intervention->pieceFournisseur->reference }}
                                </a></b>
                                @else - @endif
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <span>Intervention</span><br/>
                                <b>{{ $intervention->typeIntervention->libelle }}</b>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <span>Coût</span><br/>
                                <b>{{ number_format($intervention->cout, 0," "," ") }} F CFA</b>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <span>Début d'intervention</span>
                                <b>{{ (new \Carbon\Carbon($intervention->debut))->format('d/m/Y') }}</b>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <span>Fin d'intervention</span><br/>
                                <b>{{ (new \Carbon\Carbon($intervention->fin))->format('d/md/Y') }}</b>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span for="details">Détails</span><br/>
                                <b>{{ $intervention->details }}</b>
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <a  href="javascript:history.back();" class="btn btn-primary m-t-15 waves-effect">Fermer</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection