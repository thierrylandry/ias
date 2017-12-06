@extends("layouts.main")
@section("content")
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Modifier une famille</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-4 col-xs-6 form-control-label">
                            <label for="libelle">Nom de la famille</label>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" value="{{ $famille->id }}" name="id" id="id">
                                    <input type="text" required name="libelle" id="libelle" class="form-control" value="{{ old("libelle", $famille->libelle) }}" placeholder="Libellé de la famille">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
    @if(request()->session()->get("close"))
        <script type="application/javascript">
            window.opener.location.reload();
            window.close();
        </script>
    @endif
@endsection