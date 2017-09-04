@extends("layouts.main")

@section("content")
<div class="container-fluid">
    <div class="col-md-10 col-md-offset-1 col-sm-12">
        <div class="card">
            <div class="header">
                <h2>Veuillez sélectionner un email dans les contacts du client pour l'envoi de la facture</h2>
            </div>
            <div class="body">

                <h2>
                    Client : {{ $partenaire->raisonsociale }} <br/>
                    <small>
                        <i class="material-icons">phone</i> Contact :
                        <a href="callto:{{ $partenaire->telephone }}">{{ $partenaire->telephone }}</a>
                    </small>
                </h2>
                <!--
                @foreach($partenaire->contact as $contact)
                    @if($contact["type_c"] == "MOB" || $contact["type_c"] == "PRO" )
                        <small><i class="material-icons">phone</i> <span>{{ $contact["valeur_c"] }}</span></small>
                    @endif
                @endforeach
                -->
                <hr/>

                <form method="post" action="{{ route("email.proforma", ["reference" => $piece->referenceproforma]) }}" >
                    @foreach($partenaire->contact as $contact)
                        @if($contact["type_c"] == "EMA" )
                        <div class="form-group">
                            <input type="checkbox" id="md_checkbox_{{ $loop->index }}" name="email[]" class="chk-col-teal" checked  value="{{$contact["valeur_c"]}}"/>
                            <label for="md_checkbox_{{ $loop->index }}">{{ $contact["titre_c"] }} {{ \App\Metier\Json\Contact::getContactString($contact["type_c"])}} : </label> {{ $contact["valeur_c"] }}
                        </div>
                        <br/>
                        @endif
                    @endforeach

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="objet">Objet</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="objet" id="objet" class="form-control" value="{{ $piece->objet }}" maxlength="255" placeholder="Objet du mail au client">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ csrf_field() }}

                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label>Message</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="message" id="message" class="form-control" placeholder="Texte du message" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="row clearfix">
                        <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" id="validOrder" class="btn btn-primary m-t-15 waves-effect">
                                <i class="material-icons">send</i>
                                <span>Envoyer la facture</span>
                            </button>
                            <a target="_blank" href="{{ route("print.piececomptable",["reference"=> $piece->referenceproforma, "state" => \App\PieceComptable::PRO_FORMA]) }}" class="btn btn-default m-t-15 waves-effect">
                                <i class="material-icons">print</i>
                                <span>Imprimer la facture</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection