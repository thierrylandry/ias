@extends("mail.layout")
@section("content")

    <p></p>

    <p>Bonjour,</p>

    <p>Veuillez donc trouver en attaché notre cotation <strong>n° {{ $piece->referenceproforma }} </strong> ayant pour objet <strong> {{ $piece->objet }} </strong>.
        <br/>Tout en vous souhaitant une bonne reception, nous sommes diponible pour des dicussion visant votre satisfaction.</p>

    <p>Sincères salutation</p>
    <br/>
    {{ \Illuminate\Support\Facades\Auth::user()->employe->nom }} {{ \Illuminate\Support\Facades\Auth::user()->employe->prenoms }}
@endsection