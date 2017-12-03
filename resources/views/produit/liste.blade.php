@extends("layouts.main")
@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-4">
                        <h2>
                            Liste des produits
                        </h2>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="align-right">
                            <a href="{{ route('stock.produit.ajouter') }}" class="btn bg-blue waves-effect">Ajouter un produit</a>
                        </div>
                    </div>
                    <br class="clearfix"/>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-green">
                            <th width="7.5%"></th>
                            <th>REFERENCE</th>
                            <th>FAMILLE</th>
                            <th>LIBELLE</th>
                            <th>PRIX UNITAIRE</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($produits as $produit)
                        <tr>
                            <td>
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group btn-group-xs" role="group">
                                        <a class="btn bg-blue-grey waves-effect" href="{{ '#' }}" title="Modifier le produit"><i class="material-icons">edit</i></a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $produit->reference }}</td>
                            <td>{{ $produit->famille->libelle }}</td>
                            <td>{{ $produit->libelle }}</td>
                            <td class="text-right">{{ number_format($produit->prixunitaire,0,","," ") }} F CFA</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $produits->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection