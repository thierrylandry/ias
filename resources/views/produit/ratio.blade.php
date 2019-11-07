@extends("layouts.main")
@section("link")
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection
@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-12">
                        <h2><b>Ratio des produits</b></h2>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <form method="get">
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-6">
                                    <b>Familles</b>
                                    <select class="form-control selectpicker" id="famille" name="famille" data-live-search="true" required>
                                        <option value="all">Toutes les familles</option>
                                        @foreach($familles as $famille)
                                            <option @if($famille->id == request()->query("famille")) selected @endif value="{{ $famille->id }}">{{ $famille->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <b>Début</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input name="debut" type="text" class="form-control datepicker" placeholder="Ex: 30/07/2016" value="{{ request()->query("debut") ?? \Carbon\Carbon::now()->firstOfMonth()->format("d/m/Y") }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <b>Fin</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input name="fin" type="text" class="form-control datepicker" placeholder="Ex: 30/07/2016" value="{{ request()->query("fin") ?? Carbon\Carbon::now()->format("d/m/Y") }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <b>Disponibilité</b>
                                    <select class="form-control selectpicker" id="available" name="available" required>
                                        <option value="0" @if(3 == request()->query("available") || !request()->has("available")) selected @endif >Tout</option>
                                        <option value="2" @if(2 == request()->query("available")) selected @endif>Disponible</option>
                                        <option value="1" @if(1 == request()->query("available")) selected @endif>Indisponible</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <b>Nbre ligne</b>
                                    <select class="form-control selectpicker" id="display" name="display" required>
                                        <option value="10" @if(10 == request()->query("display")) selected @endif>10</option>
                                        <option value="30" @if(30 == request()->query("display")) selected @endif>30</option>
                                        <option value="50" @if(50 == request()->query("display")) selected @endif>50</option>
                                        <option value="100" @if(100 == request()->query("display")) selected @endif>100</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-sm bg-teal waves-button waves-effect" type="submit"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br class="clearfix"/>
                </div>
                <div class="body">
                    <h4>Graphe des sorties de produit par client</h4>
                    <canvas id="bar_chart" height="150"></canvas>
                </div>
                <hr/>
                <div class="body table-responsive">
                    <h4>Tableau des produits les plus sortis</h4>
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr class="bg-green">
                            <th>REFERENCE</th>
                            <th>FAMILLE</th>
                            <th>LIBELLE</th>
                            <th>STOCK</th>
                            <th>CONSO</th>
                            <th>DISPO</th>
                            <th>PRIX UNITAIRE</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->reference }}</td>
                            <td>{{ $produit->famille }}</td>
                            <td>{{ $produit->libelle }}</td>
                            <td class="text-right">{{ number_format($produit->stock,0,","," ") }}</td>
                            <td class="text-right">{{ number_format($produit->total,0,","," ") }}</td>
                            <td class="text-right">{{ $produit->isdisponible ? "Disponible" : "Indisponible"}}</td>
                            <td class="text-right">{{ number_format($produit->prixunitaire,0,","," ") }} F CFA</td>
                        </tr>
                        @endforeach
                        </tbody>
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
    <script type="text/javascript"  src="{{ asset('plugins/momentjs/moment-with-locales.min.js') }}"></script>
    <!-- Chart Plugins Js -->
    <script src="{{ asset("plugins/chartjs/Chart.bundle.js") }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>
    <script type="text/javascript">
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: false,
            nowButton: true,
            weekStart: 1,
            time: false,
            lang: 'fr',
            cancelText : 'ANNULER',
            nowText : 'AUJOURD\'HUI'
        });
    </script>

    <script type="text/javascript">
        $(function () {
            new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs());
        });

        function getChartJs() {
            return {
                type: 'bar',
                data: {
                    labels: [@if(count($graph))@foreach($graph["labels"] as $line)"{{ $line }}", @endforeach @endif],
                    datasets: [{
                        label: "Nombre total de produit ",
                        data: [@if(count($graph))@foreach($graph["data"]  as $line){{ $line }}, @endforeach @endif],
                        backgroundColor: 'rgba(0, 188, 212, 0.8)'
                    }]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            };
        }
    </script>
@endsection