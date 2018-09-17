@extends("layouts.main")
@php $total = 0; @endphp
@section("content")
<div class="container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="align-left col-md-6">
                        <h2>Bulletin de paie</h2>
                    </div>
                    <div class="align-right col-md-6">
                        @if($employe->previousPageUrl())
                        <a href="{{ $employe->previousPageUrl() }}" class="btn"><i class="material-icons">arrow_back</i> Précédent</a>
                        @endif

                        @if($employe->hasMorePages())
                        <a href="{{ $employe->nextPageUrl() }}" class="btn">Suivant <i class="material-icons">arrow_forward</i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="">
                    <div class="row clearfix">
                        <div id="logo" class="col-md-5 col-sm-12">
                            <img src="{{ asset('images/logo-ias.png') }}" width="250px"/>
                            <p> <br/>
                            Situté à Abobo Marché face à COCOSERVICE du coté de l'autoroute
                            <br/>Tel : +225 24 00 25 54 / +225 06 72 68 83
                            <br/>BP : 13 BP 1715 Abidjan 13
                            </p>
                            <hr />

                            <div class="row">
                                <div class="col-md-6">
                                    <p>Service : <b>{{ $employe[0]->service->libelle }}</b></p>
                                    <p>Matricule : <b>{{ $employe[0]->matricule }}</b></p>
                                    <p>Ancienneté : <b>{{ $employe[0]->matricule }}</b></p>
                                </div>
                                <div class="col-md-6">
                                    <p>N° CNPS : <b>{{ $employe[0]->cnps }}</b></p>
                                    <p>RIB : <b>{{ $employe[0]->rib }}</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-offset-3 col-md-4 col-sm-12">
                            <h3>BULLETIN DE PAIE</h3>
                            <p>Période du {{ $periode->firstOfMonth()->format("d/m/Y") }} au {{ $periode->endOfMonth()->format("d/m/Y") }}</p>
                            <br/>
                            <hr>
                            <br/>
                            <p><b>{{ strtoupper($employe[0]->nom.' '.$employe[0]->prenoms) }}</b></p>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="row clearfix">

                    </div>
                    <hr />
                    <div class="body table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                            <tr class="bg-green">
                                <th width="55%" class="text-center">Désignation</th>
                                <th width="15%" class="text-center">Base</th>
                                <th width="10%" class="text-center">Taux</th>
                                <th width="20%" class="text-center">Montant</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input disabled type="text" value="Salaire de base" class="form-control input-field" name="libelle[]"></td>
                                <td><input disabled type="number" value="{{$employe[0]->basesalaire}}" class="line-base form-control text-right input-field" name="base[]"></td>
                                <td><input disabled type="number" value="30" class="line-taux form-control text-center input-field" name="taux[]"></td>
                                <td><input disabled type="number" value="{{$employe[0]->basesalaire}}" class="line-montant form-control text-right input-field" name="montant[]"></td>

                                <input type="hidden" name="libelle[]" value="Salaire de base">
                                <input type="hidden" name="base[]" value="{{ $employe[0]->basesalaire }}">
                                <input type="hidden" name="taux[]" value="30">
                                <input type="hidden" name="montant[]" value="{{ $employe[0]->basesalaire }}">

                                @php $total += $employe[0]->basesalaire @endphp
                            </tr>
                            @foreach($missions as $mission)
                            <tr>
                                <td><input type="text" value="Mission {{$mission->code}}" class="form-control input-field" name="libelle[]"></td>
                                <td><input type="number" value="{{$mission->perdiem}}" class="line-base form-control text-right input-field" name="base[]"></td>
                                <td><input type="number" value="{{$mission->nbre_jours}}" class="line-taux form-control text-center input-field" name="taux[]"></td>
                                <td><input disabled type="number" value="{{$mission->perdiem * $mission->nbre_jours}}" class="line-montant form-control text-right input-field" name="montant[]"></td>
                                @php $total += $mission->perdiem * $mission->nbre_jours @endphp
                            </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="3"><h4 class="text-right text-uppercase">Net à payer</h4></td>
                                <td><input disabled type="number" value="{{ $total }}" class="form-control text-right input-field" name="total" id="total"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <hr />

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <input type="hidden" name="url" value="{{ $employe->nextPageUrl() }}">
                            <input type="hidden" name="employe_id" value="{{ $employe[0]->id }}">
                            <button type="submit" class="btn btn-lg bg-green m-t-15 waves-effect">Valider</button>
                            <button type="reset" class="btn btn-lg btn-default m-t-15 waves-effect">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section("script")
<script type="text/javascript">
    $(".line-base").on('change', function(e){
        var td = $(e.currentTarget).parent();
        var txt_taux = $(td).siblings().children('.line-taux');
        var txt_mtt = $(td).siblings().children('.line-montant');
        $(txt_mtt).val(parseInt($(e.currentTarget).val()) * parseInt($(txt_taux).val()));
        somme();
    });
    $(".line-taux").on('change', function(e){
        var td = $(e.currentTarget).parent();
        var txt_base = $(td).siblings().children('.line-base');
        var txt_mtt = $(td).siblings().children('.line-montant');
        $(txt_mtt).val(parseInt($(e.currentTarget).val()) * parseInt($(txt_base).val()));
        somme();
    });

    function somme() {
        var total = 0;

        $(".line-montant").each(function (i,obj) {
            total += parseInt($(obj).val());
        });

        $('#total').val(total);
    }

</script>
@endsection