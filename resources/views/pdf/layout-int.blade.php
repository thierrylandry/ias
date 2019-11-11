<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.url') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('pdf/pdf.css')}}" media="all" />
    <style>
        .page{
            page-break-after: auto;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <div>
        <div id="logo">
            <a href="{{ config('app.url') }}"><img src="{{ asset('images/logo-ias.png') }}"/></a>
        </div>
    </div>
</header>

<div id="baner">
    <div class="row titre2">
        <h2 class="h1">@yield("titre")</h2>
    </div>
</div>
<br style="clear: both;"/>
<br/>
<main class="page">
    @yield('content')
</main>

<footer>
    <p>Situé à Angré 8ème tranche</p>
    <p>Tel : +225 24 00 25 54 / +225 07 93 97 12 / +225 06 72 68 83 - 13 BP 1715 Abidjan 13</p>
    <p>N° CC 0526299 H Réel Simplifié d'Imposition Centre des Impôts d'Abobo III N° RC : CI-ABJ-2008-A-1483</p>
    <p>IBAN : CI93 CI04 2012 - Compte Bancaire BIAO N° 03536196357524  - SWIFT Code : BIAOCIABXXX</p>
    <p>Email : commercial@ivoireautoservices.net</p>
</footer>
</body>
</html>