<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ config('app.url') }}theme/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ config('app.url') }}theme/css/ias.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="bg-main">
<br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <section class="card bg-white col s12 m10 offset-m1 l4 offset-l4" >
                <div class="card-content">
                    <form class="col l12" action="" method="post">
                        {{ csrf_field() }}
                        <span class="card-title center">
                            <h2 class="center"><i class="large material-icons">perm_identity</i></h2>
                            Connexion
                            @foreach($errors->all() as $error )
                                <p class="error">{{ $error }}</p>
                            @endforeach
                        </span>
                        <div class="input-field col l12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="email" class="validate" name="login" value="{{ old('login') }}" required>
                            <label for="icon_prefix">Email</label>
                        </div>
                        <div class="input-field col l12">
                            <i class="material-icons prefix">https</i>
                            <input id="icon_password" type="password" class="validate" name="password" required>
                            <label for="icon_password">Mot de passe</label>
                        </div>
                        <div class="input-field col offset-l2 l8">
                            <button class="waves-effect waves-light btn bg-btn" type="submit">Se connecter</button>
                        </div>

                    </form>
                    <br class="clearfix"/>
                </div>
                <div class="card-action">
                    <a href="#">Mot de passe oublié</a>
                </div>
            </section>
        </div>
    </div>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="{{ config('app.url') }}theme/js/materialize.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
       Materialize.updateTextFields();
    });
</script>
</body>
</html>