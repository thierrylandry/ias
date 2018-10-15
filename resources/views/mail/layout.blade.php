<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>IAS Email</title>
    <link rel="stylesheet" type="text/css" href="{{asset('mail/mail.css')}}" media="all" />
</head>
<body>
<div>
    @yield("content")
</div>
<hr>pont
<footer class="clearfix">
    <div>
        <div id="logo">
            <a href="{{ config('app.url') }}"><img src="{{ asset('images/logo-ias.png') }}"/></a>
        </div>
    </div>
</footer>
</body>
</html>