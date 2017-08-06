<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.url') }}</title>
    <link rel="stylesheet" href="{{asset('pdf/pdf.css')}}" media="all" />
    <style>
        .page{
            page-break-after: auto;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td width="50%" class="desc head">
                <div id="logo">
                    <a href="{{ config('app.url') }}"><img src="{{ asset('images/logo-ias.png') }}"/></a>
                </div>
            </td>
            <td width="50%" class="head">
                <div id="">
                    <h2 class="name">BON DE COMMANDE</h2>
                    <div>455 Foggy Heights, AZ 85004, US</div>
                    <div>(602) 519-0450</div>
                    <div><a href="mailto:info@ivoireautoservice.net">info@ivoireautoservice.net</a></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <div id="bord"></div>
</header>
<main class="page">
    @yield('content')
</main>
<footer>
    Ivoire Auto Services &copy; {{ date('Y') }}
</footer>
</body>
</html>