@extends("mail.layout")
@section("content")

    <p></p>

    <p>Bonjour,</p>

    <p>Veuillez donc trouver en attaché notre cotation <strong>{{ App\Application::getprefixOrder() }}{{ $piece->referenceproforma }} </strong> ayant pour objet <strong> {{ $piece->objet }} </strong>.
        <br/>Tout en vous souhaitant une bonne reception, nous sommes diponible pour des dicussions visant votre satisfaction.</p>

    <p>Sincères salutation</p>
    <br/>
    {{ \Illuminate\Support\Facades\Auth::user()->employe->nom }} {{ \Illuminate\Support\Facades\Auth::user()->employe->prenoms }}
@endsection