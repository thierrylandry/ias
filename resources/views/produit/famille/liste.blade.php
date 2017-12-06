@extends("layouts.main")
@section("content")
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3>Famille de produit</h3>
                </div>
                <div class="body table-responsive">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-6" style="border-right: 1px solid #ddd ; padding:0 10px 0 0;">
                            <h3 class="text-center">Liste</h3>
                            <table class="table table-bordered table-hover ">
                                <thead>
                                <tr class="bg-green">
                                    <th width="15%"></th>
                                    <th>LIBELLE</th>
                                </tr>
                                </thead>
                                <tbody class="table-hover">
                                @foreach($familles as $famille)
                                    <tr width="8%">
                                        <td>
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group btn-group-xs" role="group">
                                                    <a class="btn bg-blue-grey waves-effect update" href="javascript:void(0);" data-url="{{ route("stock.produit.famille.modifier", ["id" => $famille->id]) }}" title="Modifier la famille"><i class="material-icons">edit</i></a>
                                                    <a class="btn bg-red waves-effect" href="#" title="Supprimer la famille"><i class="material-icons">delete</i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $famille->libelle }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-5">
                            <h3 class="text-center">Nouvelle famille</h3>
                            <form class="form-horizontal" method="post" action="{{ route("stock.produit.famille.ajouter") }}">
                                {{ csrf_field() }}
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-6 col-xs-6 form-control-label">
                                        <label for="libelle">Nom de la famille</label>
                                    </div>
                                    <div class="col-md-8 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" required name="libelle" id="libelle" class="form-control" value="{{ old("libelle") }}" placeholder="Libellé de la famille">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="application/javascript">
    $(document).ready(function () {
        $(".update").click(function (e) {
            var $a = $(e.currentTarget);
            var url = $a.data("url");
            addNewFamille(url);
        });
    });

    function addNewFamille(url) {
        var hauteur = 330;
        var largeur = 500;
        var top=(screen.height-hauteur)/2;
        var left=(screen.width-largeur)/2;
        var addFamilyWindow = window.open(url,"","menubar=no, status=no, scrollbars=auto, menubar=no, width="+largeur+", height="+hauteur+", top="+top+", left="+left);
    }
</script>
@endsection