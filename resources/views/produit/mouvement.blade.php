@extends("layouts.main")

@section("link")
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endsection

@section("content")
    <div class="container-fluid">
        <h2>Mouvements de stock</h2>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
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
                                    <div class="col-md-3 col-sm-6">
                                        <b>Référence ou nom de produit</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input name="keyword" type="text" class="form-control" placeholder="Reference ou produit" value="{{ request()->query("keyword") }}">
                                            </div>
                                            <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <b>Période du</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input name="startDate" type="text" class="form-control datepicker" placeholder="JJ/MM/AAAA" value="{{ request()->query("startDate") ?? \Carbon\Carbon::now()->firstOfMonth()->format('d/m/Y')  }}">
                                            </div>
                                            <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <b>Au</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input name="endDate" type="text" class="form-control datepicker" placeholder="JJ/MM/AAAA" value="{{ request()->query("endDate") ?? \Carbon\Carbon::now()->format('d/m/Y') }}">
                                            </div>
                                            <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <br/>
                                        <button class="btn bg-teal waves-button waves-effect" type="submit">Rechercher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br class="clearfix"/>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                            <tr class="bg-green">
                                <th width="7%"></th>
                                <th>REFERENCE</th>
                                <th>FAMILLE</th>
                                <th>LIBELLE</th>
                                <th>PRIX UNITAIRE</th>
                            </tr>
                            </thead>
                            <tbody class="table-hover">
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

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js' )}}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script type="text/javascript" >
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
@endsection