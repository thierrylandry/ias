@extends("layouts.main")

@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection

@section("content")
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row clearfix">
                @if($mission->status != \App\Statut::MISSION_TERMINEE_SOLDEE || $mission->status != \App\Statut::MISSION_ANNULEE || $mission->status != \App\Statut::MISSION_TERMINEE)
                <div class="col-md-2 col-sm-6">
                    <a class="waves-effect waves-light btn bg-light-green" href="{{ route("mission.modifier", ["reference" => $mission->code]) }}">Modifier la mission</a>
                </div>
                @endif
                @if($mission->status == \App\Statut::MISSION_COMMANDEE)
                    <div class="col-md-2 col-sm-6">
                        <a class="waves-effect waves-light btn bg-blue"  href="{{ route("mission.changer-statut", ["reference" => $mission->code, "statut" => \App\Statut::MISSION_EN_COURS, "_token" => csrf_token()]) }}">Démarrer la mission</a>
                    </div>
                @endif
                @if($mission->status == \App\Statut::MISSION_COMMANDEE)
                    <div class="col-md-2 col-sm-6">
                        <a class="waves-effect waves-light btn bg-red" href="{{ route("mission.changer-statut", ["reference" => $mission->code, "statut" => \App\Statut::MISSION_ANNULEE, "_token" => csrf_token()]) }}">Annuler la mission</a>
                    </div>
                @endif
                @if($mission->status == \App\Statut::MISSION_EN_COURS)
                    <div class="col-md-2 col-sm-6">
                        <a class="waves-effect waves-light btn bg-grey" href="{{ route("mission.changer-statut", ["reference" => $mission->code, "statut" => \App\Statut::MISSION_TERMINEE, "_token" => csrf_token()]) }}">Terminer la mission</a>
                    </div>
                @endif
                @if($mission->pieceComptable)
                    <div class="col-md-2 col-sm-6">
                        <a class="waves-effect waves-light btn bg-blue-grey" href="{{ route("facturation.details", ["reference" => $mission->pieceComptable->getReference() ]) }}">Consulter la facture</a>
                    </div>
                @endif
                @if($mission->status != \App\Statut::MISSION_TERMINEE_SOLDEE)
                    <div class="col-md-2 col-sm-6">
                        <a class="waves-effect waves-light btn bg-teal" href="{{ route("versement.mission.ajouter", ["code"=>$mission->code]) }}" title="Effectuer un versement">Effectuer un versement</a>
                    </div>
                @endif
            </div>
            <br class="clear" />

            <div class="card">
                <div class="header bg-green">
                    <h2>Détails de misssion #{{ $mission->code }} @if( $mission->soustraite ) (Mission sous-traitée) @endif [ {{ \App\Statut::getStatut( $mission->status) }} ]</h2>
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
                                <span class="">{{ $mission->getDuree() }} jours</span>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Véhicule</b>
                            <div class="input-group">
                                <span><a href="@if($mission->vehicule){{ route('vehicule.details', ['immatriculation' => $mission->vehicule->immatriculation]) }}@else # @endif">@if($mission->vehicule) {{ $mission->vehicule->marque }} {{ $mission->vehicule->typecommercial }}, {{ $mission->vehicule->immatriculation }} @else {{ $mission->immat_soustraitance }} @endif</a></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Chauffeur</b>
                            <div class="input-group">
                                <span><a href="@if($mission->chauffeur){{ route('admin.chauffeur.situation', ['matricule' => $mission->chauffeur->employe->matricule]) }}@else # @endif"> @if($mission->chauffeur) {{ $mission->chauffeur->employe->nom }} {{ $mission->chauffeur->employe->prenoms }} @else Chauffeur du soustraitant @endif</a></span>
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
                                <span class="amount devise">{{ number_format($mission->perdiem * $mission->getDuree(), 0, ",", " ") }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 font-16">
                            <b class="">Total mission</b>
                            <div class="input-group">
                                <span class="amount devise">{{ number_format($mission->montantjour * $mission->getDuree(), 0, ",", " ") }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->authorizes(\App\Service::DG, \App\Service::INFORMATIQUE,
            \App\Service::GESTIONNAIRE_PL, \App\Service::GESTIONNAIRE_VL)  )
            <div class="card">
                <div class="body">
                    <form method="post" action="">
                        <form class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="debuteffectif">Début de location</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" required name="debuteffectif" id="debuteffectif" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('debutprogramme',\Carbon\Carbon::createFromFormat("Y-m-d", $mission->debuteffectif)->format("d/m/Y"))}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="fineffective">Fin de location</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" required name="fineffective" id="fineffective" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('finprogramme',\Carbon\Carbon::createFromFormat("Y-m-d", $mission->fineffective)->format("d/m/Y")) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="observation">Observations</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea name="observation" id="observation" class="form-control" placeholder="Observations de la mission" >{{ old('observation',$mission->observation) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                                    <a href="javascript:history.back();" class="modal-close btn btn-default m-t-15 waves-effect">Annuler</a>
                                </div>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Moment Plugin Js -->
    <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>


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