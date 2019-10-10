<?php

namespace App\Http\Controllers;

use App\Pdf\PdfMaker;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use PdfMaker;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        /*
        $user = Utilisateur::where('login',"=","ahmed.kone@ivoireautoservices.net")->first();
        $user->password = bcrypt("azerty");
        $user->save(); */
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function checkState(Request $request)
    {
        return response()->json([
            "missions" => $this->checkMission(),
            "vehicules" => $this->checkVehicule(),
            "chauffeurs" =>  $this->checkChauffeur(),
            ],200,[],JSON_UNESCAPED_UNICODE);
    }

    private function checkMission()
    {
        $delai = env("DELAI_RAPPEL_MISSION",7);
        $sql = <<<EOD
        SELECT
          m.id, m.code,
          m.debuteffectif,
          datediff(m.debuteffectif,now()) AS delais,
          e.nom, e.prenoms,
          v.immatriculation,
          m.destination
        FROM
          mission m JOIN employe e ON m.chauffeur_id = e.id
          JOIN vehicule v ON v.id = m.vehicule_id
        WHERE m.status = 100 AND datediff(m.debuteffectif,now()) <= $delai
EOD;
        return DB::select($sql);
    }

    private function checkVehicule()
    {
        $delai = env("DELAI_VISITE_ASSURANCE",30);
        $sql = <<<EOD
SELECT immatriculation, marque, typecommercial,
  datediff(visite, now()) as delai_visite,
  datediff(assurance, now()) as delai_assurance
FROM vehicule
WHERE datediff(visite, now()) <= $delai OR datediff(assurance, now()) <= $delai
EOD;
        return DB::select($sql);
    }

    public function checkChauffeur()
    {
        $delai = env("DELAI_RAPPEL_PERMIS", 30);
        $sql = <<<EOD
SELECT
  e.nom, e.prenoms,
  c.expiration_c, c.expiration_d, c.expiration_e,
  datediff(c.expiration_c, now()) as delai_permis_c,
  datediff(c.expiration_d, now()) as delai_permis_d,
  datediff(c.expiration_e, now()) as delai_permis_e
FROM chauffeur c JOIN employe e ON c.employe_id = e.id
WHERE datediff(expiration_c, now()) <= $delai OR datediff(expiration_d, now()) <= $delai OR datediff(expiration_e, now()) <= $delai
EOD;

        return DB::select($sql);
    }
}