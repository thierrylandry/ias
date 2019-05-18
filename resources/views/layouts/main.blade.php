<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Bienvenue | IAS Manager Premium +</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
  <!-- Waves Effect Css -->
  <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />
  <!-- Animation Css -->
  <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />
  <!-- Morris Chart Css-->
  <link href="{{ asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />
  <!-- Custom Css -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- Our Css -->
  <link href="{{ asset('css/private.css') }}" rel="stylesheet">
  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />

  @yield('link')
</head>

<body class="theme-blue-grey">
<!-- Page Loader -->
<div class="page-loader-wrapper">
  <div class="loader">
    <div class="preloader">
      <div class="spinner-layer pl-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
    <p>Chargement en cours</p>
  </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
  <div class="search-icon">
    <i class="material-icons">Recherche</i>
  </div>
  <input type="text" placeholder="START TYPING...">
  <div class="close-search">
    <i class="material-icons">Fermer</i>
  </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
@include('layouts.appbar')
<!-- #Top Bar -->
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
      <div class="image">
        <img src="{{ asset(\Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->employe->photo)) }}" width="48" height="48" alt="User" />
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ \Illuminate\Support\Facades\Auth::user()->employe->prenoms }} {{ \Illuminate\Support\Facades\Auth::user()->employe->nom }}</div>
        <div class="email">{{ \Illuminate\Support\Facades\Auth::user()->login }}</div>
        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">
            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profil</a></li>
            <li role="seperator" class="divider"></li>
            <li><a href="{{ route("maj") }}"><i class="material-icons">autorenew</i>Mise à jour</a></li>
            <li role="seperator" class="divider"></li>
            <li><a href="{{ route("logout") }}"><i class="material-icons">input</i>Déconnexion</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
      @include('layouts.navigation')
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
      <div class="copyright">
        &copy; 2017 <a href="javascript:void(0);">{{ config("app.name") }}</a>.
      </div>
      <div class="version">
        <b>Version: </b> {{ env("APP_VERSION","1.0") }}
      </div>
    </div>
    <!-- #Footer -->
  </aside>
  <!-- #END# Left Sidebar -->
  <!-- Right Sidebar -->
  @include('layouts.rightbar')
  <!-- #END# Right Sidebar -->
</section>


<section class="content">
{{ (new \App\Metier\Behavior\Notifications)->makeAlertView() }}
@yield('content')
</section>

<!-- Jquery Core Js -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js-->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>

@yield('script')


<!-- Morris Plugin Js
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>
-->
<!-- ChartJs
<script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>
-->
<!-- Flot Charts Plugin Js
<script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('app.url') }}plugins/flot-charts/jquery.flot.time.js"></script>
-->
<!-- Sparkline Chart Plugin Js
<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
-->
<!-- Custom Js -->
<script src="{{ asset('js/admin.js') }}"></script>
<!-- Custom Js
<script src="{{ asset('js/pages/index.js') }}"></script
-->
<!-- Demo Js
<script src="{{ asset('js/demo.js') }}"></script>
-->
</body>

</html>