@extends("layouts.main")

@section("link")
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection

@section("content")
<div class="container-fluid">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-teal">
                <h2>Versement de per diem | Mission {{ $mission->code }}</h2>
            </div>
            <div class="body">
                <form class="form-horizontal font-16" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                    <div class="row clearfix">
                        <div class="col-md-offset-2 col-md-4 col-sm-6">
                            <b>Moyen de paiement</b>
                            <div class="form-group">
                                <select class="form-control selectpicker" id="moyenreglement_id" name="moyenreglement_id" data-live-search="true" required>
                                    @foreach($moyenReglements as $moyenReglement)
                                        <option value="{{ $moyenReglement->id }}">{{ $moyenReglement->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <b>Date du versement</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="dateversement" id="dateversement" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('dateversement',Carbon\Carbon::now()->format('d/m/Y H:i'))}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-offset-2 col-md-4 col-sm-6">
                            <b>Total per diem</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <h4>{{ number_format(($mission->perdiem * (new Carbon\Carbon($mission->fineffective))->diffInDays(new Carbon\Carbon($mission->debuteffectif))),0,","," ") }} </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <b>Montant payé</b>
                            <div class="input-group">
                                <div class="form-line">
                                    <input class="form-control" type="number" name="montant" id="montant" required value="{{ old("montant",0) }}">
                                </div>
                                <span class="input-group-addon">Francs CFA</span>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-offset-2 col-md-8">
                            <b>Observations</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control" name="commentaires" id="commentaires" placeholder="Observations"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn bg-teal m-t-15 waves-effect">Payer</button>
                            <button type="reset" class="btn bg-red m-t-15 waves-effect">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @php
        $total = 0;
        @endphp

        <div class="card">
            <div class="body">
                <div class="table-responsive table-hover ">
                    <table class="table">
                        <thead>
                        <tr class="bg-teal">
                            <th>Date de versement</th>
                            <th>Moyen de règlement</th>
                            <th class="amount">Montant (F CFA)</th>
                            <th width="50%">Commentaires</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($oldVersements->count())
                        @foreach($oldVersements as $oldVersement)
                        <tr>
                            <td>{{ (new \Carbon\Carbon($oldVersement->dateversement))->format("d/m/Y H:i") }}</td>
                            <td>{{ $oldVersement->moyenreglement->libelle }}</td>
                            <td class="amount">{{ number_format($oldVersement->montant,0,","," ") }}</td>
                            @php
                            $total += $oldVersement->montant;
                            @endphp
                            <td>{{ $oldVersement->commentaires }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3"><h3 class="align-center">Aucun versement pour cette mission</h3></td>
                        </tr>
                        @endif
                        </tbody>
                        <tfoot>
                        <tr class="bg-teal">
                            <th colspan="2" class="align-right">Total payé</th>
                            <th class="amount devise">{{ number_format($total, 0, ",", " ") }}</th>
                            <th class="amount devise">Reste à payer  : {{ number_format($mission->perdiem * (new Carbon\Carbon($mission->fineffective))->diffInDays(new Carbon\Carbon($mission->debuteffectif)) - $total, 0, ",", " ") }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>

<!-- Multi Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script type="text/javascript" >
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        clearButton: false,
        nowButton: true,
        weekStart: 1,
        time: true,
        lang: 'fr',
        cancelText : 'ANNULER',
        nowText : 'AUJOURD\'HUI'
    });
</script>
@endsection