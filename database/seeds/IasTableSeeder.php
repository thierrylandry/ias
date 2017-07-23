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
        ]);

        DB::table("employe")->insert([
            [
                "matricule" => "E001",
                "nom" => "Doumbia",
                "prenoms" => "Adama",
                "datenaissance" => "1970-05-12",
                "pieceidentite" => "yerv5646iog",
                "dateembauche" => "2000-01-01",
                "basesalaire" => 500000,
                "service_id" => 1,
            ],
            [
                "matricule" => "E002",
                "nom" => "Doumbia",
                "prenoms" => "Fanta",
                "datenaissance" => "1984-09-25",
                "pieceidentite" => "azer1247cvx",
                "dateembauche" => "2009-01-01",
                "basesalaire" => 300000,
                "service_id" => 1,
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
    }
}
