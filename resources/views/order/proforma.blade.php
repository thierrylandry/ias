@extends("layouts.main")

@section("link")
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

<!-- Sweetalert Css -->
<link href="{{ asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
@endsection

@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-4">
                        <h2> Facture Pro forma </h2>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                <div class="body table-responsive">
                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="referencebc">N° pro forma</label>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="referencebc" id="referencebc" class="form-control" value="{{ \App\Application::getNumeroProforma() }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="creationbc">Date</label>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="creationbc" id="creationbc" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{old('debutprogramme',Carbon\Carbon::now()->format('d/m/Y'))}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="client">Client</label>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="client" name="client" data-live-search="true" required>
                                    @foreach($partenaires as $partenaire)
                                        <option value="{{ $partenaire->id }}" data-model='{{$partenaire->contact}}'>{{ $partenaire->raisonsociale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="client">Produits</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="produits" name="produits" data-live-search="true" required>
                                    @foreach($commercializables as $commercializable)
                                        <option value="{{ $commercializable->id }}" data-price="{{ $commercializable->getPrice() }}" data-reference="{{ $commercializable->getReference() }}">{{ $commercializable->detailsForCommande() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="quantity">Quantité</label>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input name="quantity" id="quantity" type="number" class="form-control" value="1">
                                </div>
                            </div>
                        </div>

                        <button type="button" id="btnajouter" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                    </div>

                    <hr/>

                    <table id="piece" class="table table-bordered">
                        <thead>
                        <tr class="bg-teal">
                            <th width="5%">#</th>
                            <th width="10%">Référence</th>
                            <th>Description</th>
                            <th width="8%">Quantité</th>
                            <th width="10%">Prix Unitaire</th>
                            <th width="15%">Montant HT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lignes as $ligne)
                        <tr>
                            <th><a class="delete" href="javascript:void(0);"><i class="material-icons">delete_forever</i> </a></th>
                            <td>{{ $ligne->getReference() }}</td>
                            <td>{{ $ligne->detailsForCommande() }}</td>
                            <td><input type="number" class="form-control quantite" value="{{ $ligne->getQuantity() }}"></td>
                            <td class="price">{{ number_format($ligne->getPrice(),0,","," ") }}</td>
                            <td class="amount">{{ number_format($ligne->getPrice() * $ligne->getQuantity(),0,","," ") }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <div class="row clearfix">
                        <div class="col-md-offset-9 col-md-3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Montant HT</th>
                                    <th id="montantHT">450 000</th>
                                </tr>
                                <tr>
                                    <td>TVA 18%</td>
                                    <td id="montantTVA">1 200</td>
                                </tr>
                                <tr>
                                    <th>Montant TTC</th>
                                    <th id="montantTTC">451 200</th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">

                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="button"id="validOrder" class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                            <button type="reset" class="btn btn-default m-t-15 waves-effect">Retour</button>
                        </div>
                    </div>
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

<!-- SweetAlert Plugin Js -->
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

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
<script type="application/javascript">

    $("#validOrder").click(function (e) {
        swal({
            title: "Enregistrement de pro forma",
            text: "Voulez-vous ajouter cette proforma",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {
                swal("Pro forma enregistré!","Numéro de pro forma HK55454","success");
            }, 2000);
        });
    });


    /**
     * FONCTIONS POUR LE TABLEAU
     *
     * */
    $("#btnajouter").click(function (e) {
        addLine();
        calculAmount();
    });

    $(document).on("click", ".delete", function (e) {
        delLine(e.target);
    });

    $(document).on("change", ".quantite", function (e) {
        editQty(e.target);
    });

    function addLine()
    {
        $product = $("#produits option:selected");
        $quantity = $('#quantity');

        $("#piece tbody").fadeIn().append("<tr>\n" +
            "<th><a class=\"delete\" href=\"javascript:void(0);\"><i class=\"material-icons\">delete_forever</i> </a></th>\n" +
            "<td>"+ $product.data("reference") +"</td>\n" +
            "<td>"+ $product.text() +"</td>\n" +
            "<td><input type=\"number\" class=\"form-control quantite\" value=\""+ $quantity.val() +"\"></td>\n" +
            "<td class='price'>"+ $product.data("price") +"</td>\n" +
            "<td class='amount'>"+ parseInt($product.data("price")) * parseInt($quantity.val()) +"</td>\n" +
            "</tr>");
    }

    function delLine(arg)
    {
        if(confirm("Voulez-vous vraiment supprimer cette ligne ?"))
        {
            $parent_tr = $(arg).parent().parent().parent();
            $($parent_tr).fadeOut(500,function () {
                $($parent_tr).remove();
            });
        }
    }

    function calculAmount()
    {
        var montantHT = 0;
        $.each($(".amount"),function (key, value) {
            montantHT = montantHT + parseInt($(value).text());
        });

        $("#montantHT").text(montantHT);
        $("#montantTVA").text(montantHT * 0.18);
        $("#montantTTC").text(montantHT * 1.18);
    }

    function editQty(arg)
    {
        var qty = parseInt($(arg).val());
        var $td = $(arg).parent();
        var $price = $($td).siblings(".price");
        $($($td).siblings(".amount")).text( parseInt($($price).text()) * qty );

        calculAmount();
    }
</script>
@endsection