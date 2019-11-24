@extends("layouts.main")
@section("content")
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><b>Détails facture #{{ $piece->reference }}</b></h2>
                    </div>
                    <div class="body">
                        <div class="p-r-10 p-l-10">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <p class="font-15">Date facture : <b>{{ (new \Carbon\Carbon($piece->datepiece))->format("d/m/Y") }}</b></p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
                                    <p class="font-15">Référence facture : <b>{{ $piece->reference }}</b></p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6">
                                    <a class="btn btn-flat waves-effect bg-teal" href="{{ route("partenaire.fournisseur",["id" => $piece->partenaire->id]) }}">
                                        Consulter le fournisseur
                                    </a>
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
@endsection