@extends("layouts.main")
@section("content")
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Modifier produit</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="body table-responsive">
                        <div class="row clearfix">
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                                <label for="famille_id">Famille</label>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="famille_id" name="famille_id" data-live-search="true" required>
                                        @foreach($familles as $famille)
                                            <option @if($famille->id == $produit->famille_id) selected @endif value="{{ $famille->id }}">{{ $famille->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                                <label for="reference">Reference</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="reference" id="reference" class="form-control" value="{{ old("reference", $produit->reference) }}" placeholder="Reference du produit">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                                <label for="libelle">Libelle</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="libelle" id="libelle" class="form-control" value="{{ old("libelle", $produit->libelle) }}" placeholder="Nom du produit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                                <label for="prixunitaire">Prix unitaire</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" required name="prixunitaire" id="prixunitaire" class="form-control" value="{{ old("prixunitaire", $produit->prixunitaire) }}" placeholder="Prix de vente">
                                    </div>
                                    <span class="input-group-addon">F CFA</span>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                                <button type="reset" class="btn btn-default m-t-15 waves-effect">Annuler</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection