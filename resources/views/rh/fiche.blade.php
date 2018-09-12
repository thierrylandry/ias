@extends("layouts.main")
@php $total = 0; @endphp
@section("content")
<div class="container-fluid">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Bulletin de paie
                </h2>
            </div>
            <div class="body">
                <form class="form-horizontal" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="annee">Année</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select name="annee" id="annee" class="form-control input-field">
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee }}" @if(old('annee', \Carbon\Carbon::now()->year) == $annee) selected @endif> {{ $annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="mois">Mois</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select name="mois" id="mois" class="form-control input-field">
                                    @foreach($months as $mois)
                                        <option value="{{ $mois->id }}" @if(old('mois', \Carbon\Carbon::now()->month) == $mois->id) selected @endif> {{ $mois->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                            @foreach($missions as $mission)
                            <tr>
                                <td><input type="text" value="Mission {{$mission->code}}" class="form-control input-field" name="libelle[]"></td>
                                <td><input type="number" value="{{$mission->perdiem}}" class="form-control text-right input-field" name="base[]"></td>
                                <td><input type="number" value="{{$mission->nbre_jours}}" class="form-control text-center input-field" name="taux[]"></td>
                                <td><input disabled type="number" value="{{$mission->perdiem * $mission->nbre_jours}}" class="form-control text-right input-field" name="montant[]"></td>
                                @php $total += $mission->perdiem * $mission->nbre_jours @endphp
                            </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="3"><h4 class="text-right text-uppercase">Net à payer</h4></td>
                                <td><input disabled type="number" value="{{$total}}" class="form-control text-right input-field" name="total"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <hr />

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
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