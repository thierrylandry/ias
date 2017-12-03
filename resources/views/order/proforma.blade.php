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
                            <label for="objet">Objet</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="objet" id="objet" class="form-control" value="" maxlength="150" placeholder="Objet de la facture">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="client">Client</label>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="client" name="client" data-live-search="true" required>
                                    @foreach($partenaires as $partenaire)
                                        <option value="{{ $partenaire->id }}">{{ $partenaire->raisonsociale }}</option>
                                    @endforeach
                                </select>
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
                            <label for="client">Produits</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="produits" name="produits" data-live-search="true" required>
                                    <option >Veuillez sélectionner votre article SVP</option>
                                    @foreach($commercializables as $commercializable)
                                        <option value="{{ $commercializable->id }}" data-modele="{{ $commercializable->getRealModele() }}" data-id="{{ $commercializable->getId() }}" data-price="{{ $commercializable->getPrice() }}" data-libelle="{{ $commercializable->detailsForCommande() }}" data-reference="{{ $commercializable->getReference() }}">{{ $commercializable->getReference() }} {{ $commercializable->detailsForCommande() }}</option>
                                    @endforeach
                                </select>
                                <button id="addProduct" title="Ajouter un produit" class="btn bg-teal btn-circle waves-effect waves-circle waves-float"><i class="material-icons">add</i> </button>
                            </div>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                            <label for="price">Prix</label>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input name="price" id="price" type="number" class="form-control">
                                </div>
                                <span class="input-group-addon">F CFA</span>
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
                            <th data-modele="{{ $ligne->getRealModele() }}" data-id="{{ $ligne->getId() }}"><a class="delete" href="javascript:void(0);"><i class="material-icons">delete_forever</i> </a></th>
                            <td>{{ $ligne->getReference() }}</td>
                            <td>{{ $ligne->detailsForCommande() }}</td>
                            <td><input type="number" class="form-control quantite" value="{{ $ligne->getQuantity() }}"></td>
                            <td class="price text-right">{{ $ligne->getPrice() }}</td>
                            <td class="amount text-right">{{ $ligne->getPrice() * $ligne->getQuantity() }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <div class="row clearfix">
                        <div class="col-md-offset-9 col-md-3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Montant HT</th>
                                    <th id="montantHT">0</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label id="exonerelabel">TVA 18% </label> <br/>
                                        <input type="checkbox" id="isexonere" class="form-control"/>
                                        <label for="isexonere" class="">Exonéré</label>
                                    </td>
                                    <td id="montantTVA">0</td>
                                </tr>
                                <tr>
                                    <th>Montant TTC</th>
                                    <th id="montantTTC">0</th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr/>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="delailivraison">Délai de livraison</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="delailivraison" id="delailivraison" class="form-control" value="" maxlength="255" placeholder="Délai de livraison de la commande">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="conditions">Conditions de paiement</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="conditions" id="conditions" class="form-control" value="" maxlength="255" placeholder="Conditions de paiement de la commande">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="validite">Validité de l'offre</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" required name="validite" id="validite" class="form-control" value="" maxlength="255" placeholder="Validite de l'offre">
                                </div>
                            </div>
                        </div>
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
<script type="application/ecmascript">

    $("#validOrder").click(function (e) {
        swal({
            title: "Enregistrement de pro forma",
            text: "Voulez-vous ajouter cette proforma",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            saveProForma();
        });
    });

    function saveProForma() {
        var $lines = $("#piece tbody tr");
        var dataString = "[";

        if($lines.length !== 0)
        {
            $.each($lines, function (key, value) {

                if(dataString !== "[") { dataString += ", "; }

                dataString += getJsonFromTr(value);
            });
        }
        dataString += "]";

        //Ajout des champs de la facture
        dataString = '{"lignes": ' + dataString + ', '+
                '"isexonere":' + ($("#isexonere").is(":checked") ? 1 : 0) + ','+
                '"montantht":' + $("#montantHT").text()+ ','+
                '"conditions": "' + $("#conditions").val()+ '",'+
                '"validite": "' + $("#validite").val()+ '",'+
                '"delailivraison": "' + $("#delailivraison").val()+ '",'+
                '"objet": "' + $("#objet").val()+ '",'+
                '"partenaire_id":' +$("#client").val() +
                '}';

        //console.log(dataString);
        sendDataPost(JSON.parse(dataString));
    }

    function sendDataPost(data){
        $.ajax({
            type:'post',
            url: '{{ route("facturation.proforma.nouvelle") }}',
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            traditional: true,
            success: function (data, status, xhr) {
                console.log(data);
                if(data.code === 0)
                {
                    swal("Echec d'enregistrement !", data.message, "error");
                }else{
                    swal("Pro forma enregistré!",data.message,"success");
                    document.location.href = data.action;
                }

            },
            error : function (data, status, xhr) {
                swal("Echec d'enregistrement !", data.message, "error");
            }
        });
    }
    
    function getJsonFromTr(tr) {
        var $td = $(tr).children();

        return '{"id":0,'+
            '"reference": "' + $($td[1]).text() +'",' +
            '"designation": "' + $($td[2]).text() +'",' +
            '"quantite": ' + $($($td[3]).children()).val()+',' +
            '"prixunitaire": ' + $($td[4]).text() + ',' +
            '"modele": "' + $($td[0]).data("modele").replace(/\\/g, "\\\\") + '",' +
            '"modele_id": ' + $($td[0]).data("id") +
            '}';
    }
    
    /**
     * FONCTIONS POUR LE TABLEAU
     *
     * */
    $("#produits").change(function (e) {
        $("#price").val($("#produits option:selected").data("price")) ;
    });

    $("#btnajouter").click(function (e) {
        $q = $("#quantity");
        $p = $("#price");

        if($q.val() === "" || $q.val() <= 0 || $p.val() === "" || $p.val() <= 0 )
        {
            swal("Erreur","Veuillez saisir la quantité et le prix de l'article SVP","warning");
            return null;
        }

        addLine();
        calculAmount();

        $q.val(1);
    });

    $('#isexonere').click(function (e) {
        if($(e.target).is(":checked"))
            $("#exonerelabel").text("TVA 18% (Exonéré de TVA)");
        else
            $("#exonerelabel").text("TVA 18%");

        //MAJ des montants
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
            "<th data-id=\""+$product.data('id')+"\" data-modele=\""+ $product.data("modele") +"\"><a class=\"delete\" href=\"javascript:void(0);\"><i class=\"material-icons\">delete_forever</i> </a></th>\n" +
            "<td>"+ $product.data("reference") +"</td>\n" +
            "<td>"+ $product.data("libelle") +"</td>\n" +
            "<td><input type=\"number\" class=\"form-control quantite\" value=\""+ $quantity.val() +"\"></td>\n" +
            "<td class='price'>"+ $("#price").val() +"</td>\n" +
            "<td class='amount'>"+ parseInt($("#price").val()) * parseInt($quantity.val()) +"</td>\n" +
            "</tr>");
    }

    function delLine(arg)
    {
        swal({
                title: "Suppression de ligne",
                text: "Voulez-vous vraiment supprimer cette ligne ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                $parent_tr = $(arg).parent().parent().parent();
                $($parent_tr).fadeOut(500,function () {
                    $($parent_tr).remove();
                    calculAmount();
                });
            });
    }

    function calculAmount()
    {
        var montantHT = 0;
        $.each($(".amount"),function (key, value) {
            montantHT = montantHT + parseInt($(value).text());
        });

        $("#montantHT").text(montantHT);
        $("#montantTVA").text(montantHT * 0.18);

        if($("#isexonere").is(":checked"))
            $("#montantTTC").text(montantHT);
        else
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

    $("#addProduct").click(function () {
       addNewProduit();
    });

    function addNewProduit() {
        var hauteur = 600;
        var largeur = 500;
        var top=(screen.height-hauteur)/2;
        var left=(screen.width-largeur)/2;
        var addproductWindow = window.open('{{ route("stock.produit.ajouter")."?from=proforma" }}',"","menubar=no, status=no, scrollbars=auto, menubar=no, width="+largeur+", height="+hauteur+", top="+top+", left="+left);
    }

    function refreshFromNewProduct(produit) {
        console.log(produit);
        var option = '<option value="'+produit.id+'" data-modele="'+produit.modele+'" data-id="'+produit.id+'" data-price="'+produit.price+'" data-libelle="'+produit.libelle+'" data-reference="'+produit.reference+'">'+produit.reference+' '+produit.libelle+'</option>';
        console.log(option);

        $("#produits").selectpicker('deselectAll');
        $("#produits").append(option);

        $("#produits").selectpicker('refresh');
        $("#produits").selectpicker('val',produit.id);
        $("#price").val(produit.price);

        //window.location.reload(false);
    }
</script>
@endsection