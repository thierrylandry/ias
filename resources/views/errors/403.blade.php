<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Page non autorisée | {{ env('APP_NAME')}}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset("favicon.ico") }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset("plugins/bootstrap/css/bootstrap.css") }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset("plugins/node-waves/waves.css") }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset("css/style.css") }}" rel="stylesheet">
</head>

<body class="four-zero-four" style="background: #BC76B2">
<div class="four-zero-four-container">
    <div class="error-code h1"><img src="{{asset("asset/locked.jpg")}}" width="200px" /></div>
    <br>
    <br>
    <div class="error-message">Vous n'êtes pas autorisé à acceder à cette page.</div>
    <h4>Veuillez contacter votre administrateur.</h4>
    <div class="button-place">
        <a href="{{ route("home") }}" class="btn btn-default btn-lg waves-effect">Aller à la page d'accueil</a>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.js") }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset("plugins/node-waves/waves.js") }}"></script>
</body>

</html>