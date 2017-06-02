@extends("layouts.ias")

@section("title")Tableau de bord @endsection

@section('content')
<section class="container">
    <div class="row">
       <div class="col s12 m6 l4">
           <div class="card">
               <div class="card-image">
                   <img src="{{ config('app.url') }}asset/car.png">
                   <span class="card-title">mission</span>
                   <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons"></i></a>
               </div>
           </div>
       </div>
        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-image">
                    <img src="{{ config('app.url') }}asset/facture.jpg">
                    <span class="card-title">facture</span>
                    <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection