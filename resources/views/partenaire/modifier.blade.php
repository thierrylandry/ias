@extends("layouts.main")

@section("content")
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Modifier partenaire
                    </h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="raisonsociale">Raison sociale</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group"><div class="form-line">
                                        <input type="text" name="raisonsociale" id="raisonsociale" class="form-control" placeholder="Nom de l'entreprise" value="{{ old('raisonsociale', $partenaire->raisonsociale) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="comptecontribuable">N° Compte contribuable</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="comptecontribuable" id="comptecontribuable" class="form-control" placeholder="N° Compte contribuable" value="{{ old('comptecontribuable', $partenaire->comptecontribuable) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="telephone">Contact entreprise</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="N° du standard" value="{{ old('telephone', $partenaire->telephone) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 form-control-label">
                                <div class="demo-switch-title">Est client</div>
                                <div class="switch">
                                    <label><input type="checkbox" name="isclient" value="1" id="isclient" @if(old("isclient", $partenaire->isclient)) checked @endif><span class="lever switch-col-light-blue"></span></label>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 form-control-label">
                                <div class="demo-switch-title">Est Fournisseur</div>
                                <div class="switch">
                                    <label><input type="checkbox" name="isfournisseur" value="1" id="isfournisseur" @if(old("isfournisseur", $partenaire->isfournisseur)) checked @endif><span class="lever switch-col-light-blue"></span></label>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <h4>Contacts</h4>
                        Ajouter un champ
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addcontact">
                            <i class="material-icons">add</i>
                        </button>
                        <div id="contacts">

                        </div>

                        <hr/>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                                <a href="javascript:history.back();" class="btn btn-default m-t-15 waves-effect">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="contacttemplate" class="row clearfix" style="display: none">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="titre_c[]">Nom</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="titre_c[]" class="titre_c form-control" placeholder="Titre contact" value="{{ old('fullname_c[]') }}">
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="observation_c[]">Adresse</label>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-5 col-xs-5">
            <div class="form-group">
                <select type="text" name="type_c[]" class="type_c form-control input-field">
                    @foreach(\App\Metier\Json\Contact::$typeListe as $key => $typeliste)
                        <option value="{{ $key }}">{{ $typeliste }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-3 col-md-2 col-sm-7 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="valeur_c[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script type="application/javascript">
        $("#addcontact").click(function (e) {
            $($("#contacttemplate").html()).appendTo($("#contacts"));
        });
    </script>
@endsection