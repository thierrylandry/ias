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
  <link href="{{ config('app.url') }}plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="{{ config('app.url') }}plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="{{ config('app.url') }}plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- Morris Chart Css-->
  <link href="{{ config('app.url') }}plugins/morrisjs/morris.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="{{ config('app.url') }}css/style.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="{{ config('app.url') }}css/themes/all-themes.css" rel="stylesheet" />
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
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
      <a href="javascript:void(0);" class="bars"></a>
      <a class="navbar-brand" href="{{ route("home") }}">{{ config('app.name') }}</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <!-- Call Search -->
        <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
        <!-- #END# Call Search -->
        <!-- Notifications -->
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
            <i class="material-icons">notifications</i>
            <span class="label-count">7</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">NOTIFICATIONS</li>
            <li class="body">
              <ul class="menu">
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-light-green">
                      <i class="material-icons">person_add</i>
                    </div>
                    <div class="menu-info">
                      <h4>12 new members joined</h4>
                      <p>
                        <i class="material-icons">access_time</i> 14 mins ago
                      </p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-cyan">
                      <i class="material-icons">add_shopping_cart</i>
                    </div>
                    <div class="menu-info">
                      <h4>4 sales made</h4>
                      <p>
                        <i class="material-icons">access_time</i> 22 mins ago
                      </p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-red">
                      <i class="material-icons">delete_forever</i>
                    </div>
                    <div class="menu-info">
                      <h4><b>Nancy Doe</b> deleted account</h4>
                      <p>
                        <i class="material-icons">access_time</i> 3 hours ago
                      </p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-orange">
                      <i class="material-icons">mode_edit</i>
                    </div>
                    <div class="menu-info">
                      <h4><b>Nancy</b> changed name</h4>
                      <p>
                        <i class="material-icons">access_time</i> 2 hours ago
                      </p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-blue-grey">
                      <i class="material-icons">comment</i>
                    </div>
                    <div class="menu-info">
                      <h4><b>John</b> commented your post</h4>
                      <p>
                        <i class="material-icons">access_time</i> 4 hours ago
                      </p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-light-green">
                      <i class="material-icons">cached</i>
                    </div>
                    <div class="menu-info">
                      <h4><b>John</b> updated status</h4>
                      <p>
                        <i class="material-icons">access_time</i> 3 hours ago
                      </p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <div class="icon-circle bg-purple">
                      <i class="material-icons">settings</i>
                    </div>
                    <div class="menu-info">
                      <h4>Settings updated</h4>
                      <p>
                        <i class="material-icons">access_time</i> Yesterday
                      </p>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer">
              <a href="javascript:void(0);">View All Notifications</a>
            </li>
          </ul>
        </li>
        <!-- #END# Notifications -->
        <!-- Tasks -->
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
            <i class="material-icons">flag</i>
            <span class="label-count">9</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">TASKS</li>
            <li class="body">
              <ul class="menu tasks">
                <li>
                  <a href="javascript:void(0);">
                    <h4>
                      Footer display issue
                      <small>32%</small>
                    </h4>
                    <div class="progress">
                      <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <h4>
                      Make new buttons
                      <small>45%</small>
                    </h4>
                    <div class="progress">
                      <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <h4>
                      Create new dashboard
                      <small>54%</small>
                    </h4>
                    <div class="progress">
                      <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <h4>
                      Solve transition issue
                      <small>65%</small>
                    </h4>
                    <div class="progress">
                      <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    <h4>
                      Answer GitHub questions
                      <small>92%</small>
                    </h4>
                    <div class="progress">
                      <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer">
              <a href="javascript:void(0);">View All Tasks</a>
            </li>
          </ul>
        </li>
        <!-- #END# Tasks -->
        <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- #Top Bar -->
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
      <div class="image">
        <img src="{{ config('app.url') }}images/user.png" width="48" height="48" alt="User" />
      </div>
      <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ \Illuminate\Support\Facades\Auth::user()->employe->prenoms }} {{ \Illuminate\Support\Facades\Auth::user()->employe->nom }}</div>
        <div class="email">{{ \Illuminate\Support\Facades\Auth::user()->login }}</div>
        <div class="btn-group user-helper-dropdown">
          <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
          <ul class="dropdown-menu pull-right">
            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profil</a></li>
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
  <aside id="rightsidebar" class="right-sidebar">
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active in active" id="settings">
        <div class="demo-settings">
          <p>GENERAL SETTINGS</p>
          <ul class="setting-list">
            <li>
              <span>Report Panel Usage</span>
              <div class="switch">
                <label><input type="checkbox" checked><span class="lever"></span></label>
              </div>
            </li>
            <li>
              <span>Email Redirect</span>
              <div class="switch">
                <label><input type="checkbox"><span class="lever"></span></label>
              </div>
            </li>
          </ul>
          <p>SYSTEM SETTINGS</p>
          <ul class="setting-list">
            <li>
              <span>Notifications</span>
              <div class="switch">
                <label><input type="checkbox" checked><span class="lever"></span></label>
              </div>
            </li>
            <li>
              <span>Auto Updates</span>
              <div class="switch">
                <label><input type="checkbox" checked><span class="lever"></span></label>
              </div>
            </li>
          </ul>
          <p>ACCOUNT SETTINGS</p>
          <ul class="setting-list">
            <li>
              <span>Offline</span>
              <div class="switch">
                <label><input type="checkbox"><span class="lever"></span></label>
              </div>
            </li>
            <li>
              <span>Location Permission</span>
              <div class="switch">
                <label><input type="checkbox" checked><span class="lever"></span></label>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </aside>
  <!-- #END# Right Sidebar -->
</section>

@yield('content')

<!-- Jquery Core Js -->
<script src="{{ config('app.url') }}plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="{{ config('app.url') }}plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="{{ config('app.url') }}plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ config('app.url') }}plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ config('app.url') }}plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{ config('app.url') }}plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="{{ config('app.url') }}plugins/raphael/raphael.min.js"></script>
<script src="{{ config('app.url') }}plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="{{ config('app.url') }}plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="{{ config('app.url') }}plugins/flot-charts/jquery.flot.js"></script>
<script src="{{ config('app.url') }}plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="{{ config('app.url') }}plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="{{ config('app.url') }}plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="{{ config('app.url') }}plugins/flot-charts/jquery.flot.time.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{ config('app.url') }}plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="{{ config('app.url') }}js/admin.js"></script>
<script src="{{ config('app.url') }}js/pages/index.js"></script>

<!-- Demo Js -->
<script src="{{ config('app.url') }}js/demo.js"></script>
</body>

</html>