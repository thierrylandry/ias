@extends("layouts.main")
@section('link')
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <style>
        .barre{
            text-decoration: line-through;
        }
    </style>
@endsection

@section("content")
<div class="container-fluid">
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Nouvelle facture fournisseur</h3>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <form class="form-line" action="" method="post">
                        {{ csrf_field() }}

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="objet">Mode</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control selectpicker" id="mode" name="mode" required>
                                    <option value="{{ \App\Statut::PIECE_COMPTABLE_BON_COMMANDE }}">{{ \App\Statut::getStatut(\App\Statut::PIECE_COMPTABLE_BON_COMMANDE) }}</option>
                                    <option value="{{ \App\Statut::PIECE_COMPTABLE_FACTURE_AVEC_BL }}">{{ \App\Statut::getStatut(\App\Statut::PIECE_COMPTABLE_FACTURE_AVEC_BL) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="datepiece">Date facture</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="datepiece" id="datepiece" class="datepicker form-control" placeholder="JJ/MM/AAAA" value="{{ old('datepiece',\Carbon\Carbon::now()->format("d/m/Y")) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="montant">Fournisseur</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control selectpicker" id="partenaire_id" name="partenaire_id" data-live-search="true" required>
                                    @foreach($partenaires as $partenaire)
                                        <option value="{{ $partenaire->id }}" @if(old('partenaire_id', request()->query("from")) == $partenaire->id)  selected @endif >{{ $partenaire->raisonsociale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="objet">Reférence</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="reference" id="reference" class="form-control" placeholder="N° de la facture" value="{{ old('reference') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="objet">Objet</label>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" required name="objet" id="objet" class="form-control" placeholder="Objet de la facture" value="{{ old('objet') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                                <label for="client">Produits</label>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select class="form-control selectpicker" id="produits" name="produits" data-live-search="true" required>
                                        <option >Veuillez sélectionner votre article SVP</option>
                                        @foreach($commercializables as $commercializable)
                                            <option value="{{ $commercializable->id }}" data-stock="{{ $commercializable->stock ?? 0 }}" data-modele="{{ $commercializable->getRealModele() }}" data-id="{{ $commercializable->getId() }}" data-price="{{ $commercializable->getPrice() }}" data-libelle="{!! $commercializable->detailsForCommande() !!}" data-reference="{{ $commercializable->getReference() }}">{{ $commercializable->getReference() }} {!! $commercializable->detailsForCommande() !!}</option>
                                        @endforeach
                                    </select>
                                    <button id="addProduct" title="Ajouter un produit" class="btn bg-teal btn-circle waves-effect waves-circle waves-float"><i class="material-icons">add</i> </button>
                                    <span id="infoProduct" class="new badge blue"></span>
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

                        <div class="row clearfix">
                            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 form-control-label">
                                <label for="complement">Complément</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea  name="complement" id="complement" class="form-control" placeholder="Description de la ligne">{{ old('complement') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <table id="piece" class="table table-bordered">
                            <thead>
                            <tr class="bg-teal">
                                <th width="5%">#</th>
                                <th width="10%">Référence</th>
                                <th>Description</th>
                                <th class="text-right" width="8%">Quantité</th>
                                <th class="text-right" width="10%">Prix Unitaire</th>
                                <th class="text-right" width="15%">Montant HT</th>
                            </tr>
                            </thead>
                            <tbody>
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
                                            <label id="exonerelabel">TVA 18%</label> <br/>
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
                        <input type="hidden" required name="montanttva" id="montanttva"  value="">
                        <input type="hidden" required name="montantht" id="montantht"  value="">

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-6 col-xs-12 form-control-label">
                                <label for="observation">Observation</label>
                            </div>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea maxlength="255" name="observation" id="observation" class="form-control" placeholder="Observations">{{ old('montant') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                                <button type="reset" class="btn btn-default m-t-15 waves-effect">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Moment Plugin Js -->
    <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
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
    <script type="text/javascript">
        $("#produits").change(function (e) {
            $("#price").val($("#produits option:selected").data("price")) ;
            var stock = $("#produits option:selected").data("stock");
            if(stock != 'no'){
                $("#infoProduct").text( stock +" produit(s) en stock");
            }
        });

        $("#btnajouter").click(function (e) {
            $q = $("#quantity");
            $p = $("#price");

            if($q.val() === "" || $q.val() <= 0 || $p.val() === "" || $p.val() <= 0 ){
                swal("Erreur","Veuillez saisir la quantité et le prix de l'article SVP","warning");
                return null;
            }

            addLine();
            calculAmount();

            $q.val(1);
            $("#remise").val(0.0);
        });

        $('#isexonere').click(function (e) {
            if($(e.target).is(":checked"))
                $("#exonerelabel").addClass("barre");
            else
                $("#exonerelabel").removeClass("barre");

            //MAJ des montants
            calculAmount();
        });

        $(document).on("click", ".delete", function (e) {
            delLine(e.target);
        });

        $(document).on("change", ".quantite", function (e) {
            editQty(e.target);
        });

        function addLine() {
            $product = $("#produits option:selected");
            $quantity = $('#quantity');

            var id = $product.data('id') == undefined ? 0 : $product.data('id');
            var modele = $product.data("modele") == undefined ? '{{ \App\Intervention::class }}' : $product.data("modele");
            var libelle = $product.data("libelle") == undefined ? $("#complement").val() : $product.data("libelle") + " " + $("#complement").val();
            var reference = $product.data("reference") == undefined ? '#' : $product.data("reference");
            var amount = (parseInt($("#price").val()) * parseInt($quantity.val()));

            $("#piece tbody").fadeIn().append("<tr>\n" +
                "<th><a class=\"delete\" href=\"javascript:void(0);\"><i class=\"material-icons\">delete_forever</i> </a></th>\n" +
                "<td><input type=\"hidden\" name=\"produit_id[]\" value=\""+id+"\">"+ reference +"</td>\n" +
                "<td><input type=\"hidden\" name=\"designation[]\" value=\""+ libelle +"\">"+ libelle + " "+"</td>\n" +
                "<td class='text-center'><input type=\"hidden\" name=\"quantite[]\" value=\""+ $quantity.val() +"\">"+$quantity.val()+"</td>\n" +
                "<td class='price text-right' ><input type=\"hidden\" name=\"prix[]\" value=\""+$("#price").val() +"\">"+ $("#price").val() +"</td>\n" +
                "<td class='amount text-right'><input type=\"hidden\" name=\"modele[]\" value=\""+modele+"\">"+ amount +"</td>\n" +
                "</tr>");
        }

        //<input type="hidden" name="modele[]" value="">

        function delLine(arg) {
            if(confirm("Voulez-vous variment supprimer cette ligne ?")){
                $parent_tr = $(arg).parent().parent().parent();
                $($parent_tr).fadeOut(500,function () {
                    $($parent_tr).remove();
                    calculAmount();
                });
            }
        }

        function calculAmount()
        {
            var montantHT = 0;
            $.each($(".amount"),function (key, value) {
                montantHT = montantHT + parseInt($(value).text());
            });

            var taux = 0.18;
            if($("#isexonere").is(":checked")){
                taux = 0;
            }

            $("#montantHT").text(montantHT);

            $("#montantTVA").text(Math.ceil(montantHT * taux));
            $("#montantTTC").text(Math.ceil(montantHT * (1+taux)));

            $("#montanttva").val(Math.ceil(montantHT*taux));
            $("#montantht").val(montantHT);


        }

        function editQty(arg)
        {
            var qty = parseInt($(arg).val());
            var $td = $(arg).parent();
            var $price = $($td).siblings(".price");
            var $remise = $($td).siblings(".remise");
            var $amount = (parseInt($($price).text()) * qty) - (parseInt($($price).text()) * qty * (parseFloat($($remise).text())/100));
            $($($td).siblings(".amount")).text( $amount );

            calculAmount();
        }

        $("#addProduct").click(function () {
            addNewProduit();
        });

        /**
         * Appelé par la fenêtre fille qui ouvre le popup d'ajout de produit
         */
        function addNewProduit() {
            var hauteur = 600;
            var largeur = 500;
            var top=(screen.height-hauteur)/2;
            var left=(screen.width-largeur)/2;
            var addproductWindow = window.open('{{ route("stock.produit.ajouter")."?from=proforma" }}',"","menubar=no, status=no, scrollbars=auto, menubar=no, width="+largeur+", height="+hauteur+", top="+top+", left="+left);
        }

        function refreshFromNewProduct(produit) {
            console.log(produit);
            var option = '<option value="'+produit.id+'" data-stock="0" data-modele="'+produit.modele+'" data-id="'+produit.id+'" data-price="'+produit.price+'" data-libelle="'+produit.libelle+'" data-reference="'+produit.reference+'">'+produit.reference+' '+produit.libelle+'</option>';
            //console.log(option);

            $("#produits").selectpicker('deselectAll');
            $("#produits").append(option);

            $("#produits").selectpicker('refresh');
            $("#produits").selectpicker('val',produit.id);
            $("#price").val(produit.price);

            //window.location.reload(false);
        }
    </script>
@endsection