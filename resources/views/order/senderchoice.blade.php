@extends("layouts.main")

@section("content")
<div class="container-fluid">
    <div class="col-md-10 col-md-offset-1 col-sm-12">
        <div class="card">
            <div class="header">
                <h2>Veuillez choisir au moins un email dans les contacts du client pour l'envoie de la facture ...</h2>
            </div>
            <div class="body">

                <h2>
                    Client : {{ $partenaire->raisonsociale }}
                    @foreach($partenaire->contact as $contact)
                        @if($contact["type_c"] == "MOB" || $contact["type_c"] == "PRO" )
                            <small><i class="material-icons">phone</i> <span>{{ $contact["valeur_c"] }}</span></small>
                        @endif
                    @endforeach
                </h2>
                <hr/>

                <form method="post" action="" >
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