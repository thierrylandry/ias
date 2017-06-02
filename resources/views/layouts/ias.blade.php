<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ config('app.url') }}theme/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ config('app.url') }}theme/css/ias.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div class="row">
    <div class="col l2 bg-second z-depth-2" id="navigation">

    </div>
    <div class="col l10">
        <div class="bar bg-white ">
            <a class="btn-floating btn blue pulse"><i class="material-icons">menu</i></a>
        </div>
        <section>
            @yield('content')
        </section>

    </div>
    <footer>

    </footer>
</div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="{{ config('app.url') }}theme/js/materialize.min.js"></script>
</body>
</html>