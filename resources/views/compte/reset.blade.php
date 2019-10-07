@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="header bg-danger">
                    <h3>Sous compte : {{ $souscompte->libelle }} | solde : <b class="bg-green">{{ number_format($solde, 0,',',' ') }} FCFA </b></h3>
                    <hr/>
                    <form class="bg-danger" action="" method="post">
                        <div class="row">
                            <div class="col-md-12 p-b-15" style="padding: 15px;">
                                <h3>Voulez vraiment remettre à zéro le sous compte {{ $souscompte->libelle }} ?</h3>
                                <p>La suppression de ce compte supprimera toutes les lignes du compte et remettra le solde du compte à 0.</p>
                                <p>Pour supprimer le compte également, vous pouvez cocher la case ci-dessous.</p>

                                <p>
                                    <label>
                                        <input type="checkbox" style="position: relative; left:0px; top: 5px; opacity: 1; height: 20px; width: 25px;" name="delete_account">
                                        <span>Je veux supprimer également le compte.</span>
                                    </label>
                                </p>

                                <hr/>
                                <div class="row clearfix">
                                    {{ csrf_field() }}
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-danger m-t-15 waves-effect">Valider</button>
                                        <a href="javascript:history.back();" class="btn btn-default m-t-15 waves-effect">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection