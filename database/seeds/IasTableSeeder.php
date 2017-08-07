<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class IasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("service")->insert([
            [ "code" => "INFO", "libelle" => "Informatique" ],
            [ "code" => "COMPT","libelle" => "Comptabilité" ],
            [ "code" => "LOGIS","libelle" => "Logistique" ],
        ]);

        DB::table("employe")->insert([
            [
                "matricule" => "E001",
                "nom" => "Touré",
                "prenoms" => "Brice",
                "datenaissance" => "1970-05-12",
                "pieceidentite" => "yerv5646iog",
                "dateembauche" => "2000-01-01",
                "basesalaire" => 500000,
                "service_id" => 1,
            ],
            [
                "matricule" => "E002",
                "nom" => "Kouassi",
                "prenoms" => "Yannick",
                "datenaissance" => "1984-09-25",
                "pieceidentite" => "azer1247cvx",
                "dateembauche" => "2009-01-01",
                "basesalaire" => 300000,
                "service_id" => 1,
            ],
            [
                "matricule" => "E003",
                "nom" => "Toutou",
                "prenoms" => "Benjamin",
                "datenaissance" => "1984-09-25",
                "pieceidentite" => "C986512151044",
                "dateembauche" => "2009-01-01",
                "basesalaire" => 200000,
                "service_id" => 3,
            ],
            [
                "matricule" => "E004",
                "nom" => "Touré",
                "prenoms" => "Sekou",
                "datenaissance" => "1984-09-25",
                "pieceidentite" => "C801487021121",
                "dateembauche" => "2009-01-01",
                "basesalaire" => 200000,
                "service_id" => 3,
            ],
        ]);

        DB::table("utilisateur")->insert([
            [
                "login" => "glamolondon@gmail.com" ,
                "password" => bcrypt("azerty"),
                "employe_id" => 1
            ],
            [
                "login" => "thierrylandryk@gmail.com" ,
                "password" => bcrypt("azerty"),
                "employe_id" => 2
            ]
        ]);

        DB::table('chauffeur')->insert([
            [
                'employe_id' => '3',
                'permis' => 'PM544 054545 544',
            ],
            [
                'employe_id' => '3',
                'permis' => 'PM987 018780 545',
                'expiration_c' => '2019-05-26',
                'expiration_d' => '2019-05-26',
                'expiration_e' => '2019-05-26',
            ],
        ]);

        DB::table('genre')->insert([
            ['libelle' => 'Berline'],
            ['libelle' => 'Camionnette'],
            ['libelle' => 'Cyclomoteur'],
            ['libelle' => 'Auto-bus'],
            ['libelle' => 'Moto'],
            ['libelle' => 'Tracteur routier'],
            ['libelle' => 'Véhicule particulier'],
            ['libelle' => 'Véhicule utilitaire'],
        ]);
    }
}
