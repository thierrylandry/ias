@extends("layouts.main")
@section("content")
    <div class="container-fluid">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h3>Modifier sous-compte : {{ $souscompte->libelle }}</h3>
                </div>
                <div class="body">
                    <form class="form-line" action="" method="post">
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
                                            <option @if(old('employe_id', $souscompte->employe_id) == $utilisateur->employe_id) selected @endif value="{{ $utilisateur->employe_id }}" >{{ $utilisateur->employe->nom }} {{ $utilisateur->employe->prenoms }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12 col-xs-12 form-group">
                                <input type="checkbox" name="can_appro" id="can_appro" class="chk-col-teal" @if($souscompte->can_appro) checked @endif/>
                                <label for="can_appro">Peut approvisionner le sous-compte</label>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-3 col-xs-12 form-control-label">
                                <label for="libelle">Titre</label>
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <div class="form-group">
                                    <input type="text" required name="libelle" id="libelle" class="form-control" placeholder="Libellé du sous-compte" value="{{ old('libelle', $souscompte->libelle) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-3 col-xs-12 form-control-label">
                                <label for="commentaire">Commentaire</label>
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <div class="form-group">
                                    <textarea maxlength="255" id="commentaire" name="commentaire" class="form-control" placeholder="Note sur le sosu-compte">{{ old('commentaire',$souscompte->commentaire) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                                <a href="javascript:history.back();" data-dismiss="modal" class="btn btn-default m-t-15 waves-effect">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection