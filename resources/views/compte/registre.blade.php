@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="header">
                <h3>Mes comptes</h3>
            </div>
            <div class="body">
                <div class="row clearfix">
                    @if(\Illuminate\Support\Facades\Auth::user()->authorizes(
                        \App\Service::INFORMATIQUE, \App\Service::ADMINISTRATION)
                    )
                    <div class="col-md-2 col-sm-6">
                        <button class="btn bg-blue waves-button waves-effect" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i> Nouveau compte</button>
                    </div>
                    @endif
                </div>
                <div class="row clearfix">
                    <div class="body table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                            <tr class="bg-green">
                                <th width="10%"></th>
                                <th>Livre</th>
                                <th width="20%">Date création</th>
                                <th>Solde</th>
                                <th>Gestionnaire</th>
                            </tr>
                            </thead>
                            <tbody class="table-hover">
                            @foreach($comptes as $compte)
                                <tr>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group btn-group-xs" role="group">
                                                <a class="btn bg-orange waves-effect" href="javascript:void(0);" onclick="edit('{{ $compte->id }}','{{ (new \Carbon\Carbon($compte->datecreation))->format('d/m/Y') }}','{{ $compte->libelle }}');" title="Modifier"><i class="material-icons">edit</i></a>
                                                <a class="btn bg-teal waves-effect" href="{{ route('compte.souscompte', ['slug' => $compte->slug]) }}" title="Détails"><i class="material-icons">description</i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $compte->libelle }}</td>
                                    <td>{{ (new \Carbon\Carbon($compte->datecreation))->format('d/m/Y H:i:s') }}</td>
                                    <td class="align-right">{{ number_format(count($compte->lignecompte) != 0 ? $compte->lignecompte->first()->balance : 0, 0, ',',' ') }}</td>
                                    <td>{{ $compte->utilisateur->nom ?? 'N/D' }} {{ $compte->utilisateur->prenoms ?? null }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form class="form-line" action="" method="post">
            <div class="modal-content">
                <div class="modal-header bg-light-green">
                    <h4 class="modal-title" id="defaultModalLabel">Nouveau sous-compte</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="sens">Gestionnaire</label>
                        </div>
                        <div class="col-md-8 col-xs-12 ">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="employe_id" name="employe_id" required>
                                    <option @if(old('employe_id') == '-1') selected @endif value="-1" >Par défaut</option>
                                    @foreach($utilisateurs as $utilisateur)
                                    <option @if(old('employe_id') == $utilisateur->employe_id) selected @endif value="{{ $utilisateur->employe_id }}" >{{ $utilisateur->employe->nom }} {{ $utilisateur->employe->prenoms }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="libelle">Titre</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <input type="text" required name="libelle" id="libelle" class="form-control" placeholder="Libellé du sous-compte" value="{{ old('libelle') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-3 col-xs-12 form-control-label">
                            <label for="commentaire">Commentaire</label>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <textarea maxlength="255" id="commentaire" name="commentaire" class="form-control" placeholder="Note sur le sosu-compte">{{ old('commentaire') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                            <button type="reset" data-dismiss="modal" class="btn btn-default m-t-15 waves-effect">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section("script")
    <script type="text/javascript">

        function edit(id, commentaire, objet) {
            $('#md-id').val(id);
            $('#md-commentaire').val(commentaire);
            $('#md-libelle').val(objet);
            $('#editModal').modal('show');
        }

    </script>
@endsection