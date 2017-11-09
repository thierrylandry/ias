@extends("layouts.main")

@section("content")
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3>{{ $employe->nom }} {{ $employe->prenoms }}</h3>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-3 col-sm-5 col-xs-12">
                            <img class="right" src="{{ asset(\Illuminate\Support\Facades\Storage::url($employe->photo)) }}">
                        </div>
                        <div class="col-md-9 col-sm-7 col-xs-12">
                            <p></p>
                            <p><i class="material-icons">call</i> <span class="relative-8">{{ $employe->contact }}</span></p>
                            <p><i class="material-icons">featured_play_list</i> <span class="relative-8">{{ $employe->pieceidentite }}</span></p>
                            <p><i class="material-icons">cake</i> <span class="relative-8">{{ (new \Carbon\Carbon($employe->datenaissance))->format('d/m/Y') }}</span></p>
                        </div>
                    </div>
                    <hr/>
                    <div class="col-md-12">
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">business</i> <span class="relative-8">{{ $employe->service->libelle }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">file_download</i> <span class="relative-8">{{  (new \Carbon\Carbon($employe->dateembauche))->format('d/m/Y') }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <i class="material-icons">monetization_on</i> <span class="relative-8 devise">{{ number_format($employe->basesalaire, 0, "."," ") }}</span>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            @if($employe->datesortie)
                            <i class="material-icons">file_upload</i> <span class="relative-8">{{ $employe->datesortie }}</span>
                            @endif
                        </div>
                    </div>

                    <br class="clearfix"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection