@extends("layouts.main")

@section("link")
@endsection

@section("content")
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{{ ucfirst(\App\Statut::getStatut($piece->etat)) }} {{ $piece->getReference() }}</h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <a href="#" class="btn btn-flat waves-effect bg-teal"><i class="material-icons">refresh</i> Créer à partir de cette Pro forma</a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <form action="" method="post">
                                <input type="hidden" name="referenceproforma" value="{{ $piece->referenceproforma }}">
                                <button class="btn btn-flat waves-effect bg-teal"><i class="material-icons">loop</i> Transformer en facture</button>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <a href="#" class="btn btn-flat waves-effect bg-teal"><i class="material-icons">local_shipping</i> Générer le bon de livraison</a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <a href="#" class="btn btn-flat waves-effect bg-teal"><i class="material-icons">print</i> Imprimer</a>
                        </div>
                    </div>

                    <hr/>

                    <div class="p-r-10 p-l-10">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <p class="font-15">Date Pro forma : {{ (new \Carbon\Carbon($piece->creationproforma))->format("d/m/Y") }}</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                @if($piece->creationfacture)
                                <p class="font-15">Date facture : {{ (new \Carbon\Carbon($piece->creationfacture))->format("d/m/Y") }}</p>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                @if($piece->creationbl)
                                <p class="font-15">Date bon de livraison : {{ (new \Carbon\Carbon($piece->creationbl))->format("d/m/Y") }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <p class="font-15">Référence Pro forma : {{ $piece->referenceproforma }}</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                @if($piece->referencefacture)
                                    <p class="font-15">Référence facture : {{ $piece->referencefacture }}</p>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                @if($piece->referencebl)
                                    <p class="font-15">Référence bon de livraison : {{ $piece->referencebl }}</p>
                                @endif
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <p class="h4">Client : <a href="#ficheclient">{{ $piece->partenaire->raisonsociale }}</a></p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <p class="h4">Contact : <a href="callto:{{ $piece->partenaire->telephone }}">{{ $piece->partenaire->telephone }}</a></p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <p class="h4">N°compte contibuable : {{ $piece->partenaire->comptecontribuable }}</p>
                            </div>
                        </div>

                        <div class="objet"><span><strong>Objet : </strong>{{ $piece->objet }}</span></div>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr class="bg-light-green">
                                    <th width="7%">Référence</th>
                                    <th width="55%">Désignation</th>
                                    <th width="12%" class="amount">P.U HT</th>
                                    <th class="quantity text-center">Quantité</th>
                                    <th width="15%" class="amount">Total</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                @foreach($piece->lignes as $ligne)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="">{{ $ligne->designation }}</td>
                                        <td class="amount">{{ number_format($ligne->prixunitaire,0,',',' ') }}</td>
                                        <td class="quantity text-center">{{ number_format($ligne->quantite,0,',',' ') }}</td>
                                        <td class="amount">{{ number_format($ligne->prixunitaire * $ligne->quantite,0,',',' ') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2" class="amount font-bold">Montant HT</td>
                                    <td class="amount font-bold">{{ number_format($piece->montantht,0,','," ") }} FCFA</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2" class="amount font-bold">TVA 18% @if($piece->isexonere)<small>(Exonéré de TVA)</small> @endif</td>
                                    <td class="amount font-bold">{{ number_format(($piece->montantht * $piece->tva),0,','," ") }} FCFA</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2" class="amount font-bold">Montant TTC</td>
                                    <td class="amount font-bold">{{ number_format(($piece->montantht * ($piece->isexonere ? 1 : (1 + $piece->tva) )),0,','," ") }} FCFA</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
@endsection