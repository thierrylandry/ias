@extends("mail.layout")
@section("content")
    <p></p>
    <br />
    <br />

    <p>Bonjour,</p>

    <p>Les missions suivantes débuterons moins de {{ \App\Metier\Finance\NombreToLettre::getLetter(intval(env('APP_MISSION_REMINDER'))) }} ({{env('APP_MISSION_REMINDER')}}) jour(s) :</p>
    <ul>
        @foreach($missions as $mission)
        <li>
            <p>Mission {{ $mission->clientPartenaire->raisonsociale }}  débutera le {{ (new \Carbon\Carbon($mission->debuteffectif))->format('d/m/Y') }} soit dans {{ \Carbon\Carbon::now()->diffInDays((new \Carbon\Carbon($mission->debuteffectif))) }} jour(s).
            <br />- Destination(s): {{ $mission->destination }}
            <br />- Chauffeur : {{ $mission->chauffeur->employe->nom }} {{ $mission->chauffeur->employe->prenoms }}
            <br />- Véhicule : {{ $mission->vehicule->immatriculation }} - {{ $mission->vehicule->marque }} {{ $mission->vehicule->typecommercial }}
            </p>
        </li>
        @endforeach
    </ul>
    <br/>
    Mail envoyé automatiquement par <strong>{{ env('APP_NAME') }}</strong>
@endsection