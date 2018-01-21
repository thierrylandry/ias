@extends("layouts.main")

@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection

@section("content")
@php
$rap = 0;
@endphp
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <h3>Point client : {{ $partenaire->raisonsociale }}</h3>
                        </div>
                        <div class="col-md-4 col-xs-12 align-right">
                            <button class="btn btn-flat waves-effect bg-teal" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">money</i>Reglement facture</button>
                        </div>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-green">
                            <th>Date</th>
                            <th>N° Facture</th>
                            <th>N° Pro forma</th>
                            <th>N° BL</th>
                            <th>Objet</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Moyen Paiement</th>
                            <th>Date de paiement</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($pieces)
                        @foreach($pieces as $piece)
                        <tr>
                            <td>{{ (new \Carbon\Carbon($piece->creationfacture ?? $piece->creationproforma))->format('d/m/Y') }}</td>
                            <td><a href="{{ route('facturation.details',['refrence' => $piece->referenceproforma]) }}">{{ $piece->referencefacture }}</a></td>
                            <td><a href="{{ route('facturation.details',['refrence' => $piece->referenceproforma]) }}">{{ $piece->referenceproforma }}</a></td>
                            <td>{{ $piece->referencebl }}</td>
                            <td>{{ $piece->objet }}</td>
                            <td>{{ number_format($piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva), 0, '', ' ') }}</td>
                            <td>{{ \App\Statut::getStatut($piece->etat) }}</td>
                            <td><span title="{{ $piece->remarquepaiement }}">{{ $piece->moyenPaiement ? $piece->moyenPaiement->libelle : null }}</span></td>
                            <td>{{ $piece->datereglement ? (new \Carbon\Carbon($piece->datereglement))->format('d/m/Y') : null }}</td>
                        </tr>
                        @php
                            if($piece->etat != \App\Statut::PIECE_COMPTABLE_FACTURE_PAYEE){
                                $rap += $piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva);
                            }
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="10"><h5>Total : {{ number_format($rap, 0, '', ' ') }} F CFA</h5></td>
                        </tr>
                        @else
                            <td colspan="10">
                                <h3>Aucune pièce comptable n'a été passée avec ce client !</h3>
                            </td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form class="form-line" action="{{ route("versement.facture.client") }}" method="post">
            <div class="modal-content">
                <div class="modal-header bg-light-green">
                    <h4 class="modal-title" id="defaultModalLabel">Règlement de facture client</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="datereglement">Date</label>
                        </div>
                        <div class="col-md-8 col-xs-12 ">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="datereglement" id="datereglement" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('datereglement',\Carbon\Carbon::now()->format("d/m/Y")) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label>Liste des factures</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                            @foreach($pieces as $piece)
                                @if($piece->etat != \App\Statut::PIECE_COMPTABLE_FACTURE_PAYEE)
                                    <input type="checkbox" id="md_checkbox_{{ $piece->id }}" name="facture[]" class="chk-col-teal" checked  value="{{ $piece->id }}"/>
                                    <label for="md_checkbox_{{ $piece->id }}">{{ $piece->referencefacture }} {{ $piece->objet }} : </label> {{ number_format($piece->montantht * 1+ ($piece->isexonere ? 0 : $piece->tva), 0, '', ' ') }} F CFA
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="moyenpaiment_id">Moyen de paiement</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="moyenpaiement_id" name="moyenpaiement_id" required>
                                    @foreach($moyenReglements as $moyenReglement)
                                        <option value="{{ $moyenReglement->id }}">{{ $moyenReglement->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="remarquepaiement">Observations</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <textarea maxlength="220" id="remarquepaiement" name="remarquepaiement" class="form-control" placeholder="Note sur le paiement"></textarea>
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
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>
    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" >
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