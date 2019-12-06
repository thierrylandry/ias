@extends("layouts.main")
@section("content")
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-md-7">
                                <h2><b>Détails pièce #{{ $piece->reference ??  $piece->numerobc }} - {{ \App\Statut::getStatut($piece->statut) }}</b></h2>
                            </div>
                            <div class="col-md-2">
                                @if(\Illuminate\Support\Facades\Auth::user()->authorizes(\App\Service::DG, \App\Service::INFORMATIQUE))
                                    <a class="align-right btn btn-flat waves-effect bg-red" href="{{ route("partenaire.bc.valide", ['id' => $piece->id]) }}">Valider le BC</a>
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if(in_array($piece->statut, [\App\Statut::PIECE_COMPTABLE_BON_COMMANDE,\App\Statut::PIECE_COMPTABLE_BON_COMMANDE_VALIDE ]))
                                <a class="align-right btn btn-flat waves-effect bg-light-green" target="_blank" href="{{ route("print.bc", ["id"=> $piece->id]) }}">Imprimer</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="body">
                        <div class="p-r-10 p-l-10">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p class="font-15">Date facture : <b>{{ (new \Carbon\Carbon($piece->datepiece))->format("d/m/Y") }}</b></p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                    <p class="font-15">Référence facture : <b>{{ $piece->reference }}</b></p>
                                    <p class="font-15">Numéro BC : <b>{{ $piece->numerobc }}</b></p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                                    <a class="btn btn-flat waves-effect bg-teal" href="{{ route("partenaire.fournisseur",["id" => $piece->partenaire->id]) }}">
                                        Consulter le fournisseur
                                    </a>
                                    @if($piece->statut == \App\Statut::PIECE_COMPTABLE_BON_COMMANDE)
                                    <a class="btn btn-flat tranform waves-effect bg-light-blue">Transformer en Facture</a>
                                    @endif
                                </div>
                            </div>

                            <hr/>

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p class="h4">Fournisseur : <a href="{{ route("partenaire.client", [ "id" => $piece->partenaire->id ]) }}"><b>{{ $piece->partenaire->raisonsociale }}</b></a></p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p class="h4">Contact : <a href="callto:{{ $piece->partenaire->telephone }}"><b>{{ $piece->partenaire->telephone }}</b></a></p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p class="h4">N° CC : <b>{{ $piece->partenaire->comptecontribuable }}</b></p>
                                </div>
                            </div>

                            <div class="objet"><span><strong>Objet : </strong>{{ $piece->objet }}</span></div>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr class="bg-light-green">
                                        <th width="10%">Référence</th>
                                        <th width="55%">Désignation</th>
                                        <th width="12%" class="amount">P.U HT</th>
                                        <th class="quantity text-center">Quantité</th>
                                        <th width="15%" class="amount">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody class="">
                                    @foreach($piece->lignes as $ligne)
                                        <tr>
                                            <td class="text-center">{{ $ligne->reference ? $ligne->reference : "#"  }}</td>
                                            <td class="">{{ $ligne->designation }}</td>
                                            <td class="amount">{{ number_format($ligne->prix,0,',',' ') }}</td>
                                            <td class="quantity text-center">{{ number_format($ligne->quantite,0,',',' ') }}</td>
                                            <td class="amount">{{ number_format(($ligne->prix * $ligne->quantite),0,',',' ') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2" class="amount font-bold">Montant HT</td>
                                        <td colspan="2" class="amount font-bold">{{ number_format($piece->montantht,0,','," ") }} FCFA</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2" class="amount font-bold">TVA 18%</td>
                                        <td colspan="2" class="amount font-bold">{{ number_format($piece->montanttva,0,','," ") }} FCFA</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2" class="amount font-bold">Montant TTC</td>
                                        <td colspan="2" class="amount font-bold">{{ number_format($piece->montantht + $piece->montanttva,0,','," ") }} FCFA</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-4 col-xs-12">
                                <blockquote class="blockquote">
                                    <p class="font-underline">Montant en lettre</p>
                                    <footer>Facture arrêté à la somme de {{ \App\Metier\Finance\NombreToLettre::getLetter(intval($piece->montantht) + $piece->montanttva) }} francs CFA</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form class="form-line" action="{{ route("partenaire.bc.switch") }}" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-light-green">
                        <h4 class="modal-title" id="defaultModalLabel">Passer de BC à facture</h4>
                    </div>
                    <div class="modal-body row">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $piece->id }}">
                        <div class="col-md-4">
                            <label class="form-label">N° facture</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" required class="form-control date" placeholder="N° facture fournisseur" name="reference" id="reference">
                                </div>
                                <span class="input-group-addon">
                                    <i class="material-icons">send</i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect">Valider</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("script")
    <script type="application/javascript">
        $(function () {
            $('.tranform.btn').on('click', function () {
                $('#defaultModal').modal('show');
            });
        });
    </script>
@endsection