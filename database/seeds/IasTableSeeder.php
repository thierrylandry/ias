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
        DB::table("application")->insert([
            [
                "version" => "1",
                "sendmail" => "Y",
                "mailcopy" => "commercial@ivoireautoservices.net",
                "numeroproforma" => 1,
                "numerobl" => 1,
                "numerofacture" => 1,
                "prefix" => ""
            ],
        ]);

        DB::table("service")->insert([
            [ "code" => "INFO", "libelle" => "Informatique" ],
            [ "code" => "COMPT","libelle" => "Comptabilité" ],
            [ "code" => "LOGIS","libelle" => "Logistique" ],
        ]);

        DB::table("employe")->insert([
            [
                "matricule" => "E001",
                "nom" => "Koffi",
                "prenoms" => "Bérenger",
                "datenaissance" => "1990-05-12",
                "pieceidentite" => "C 0045 54548",
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
            [
                "matricule" => "E005",
                "nom" => "Touré",
                "prenoms" => "Brice",
                "datenaissance" => "1970-05-12",
                "pieceidentite" => "yerv5646iog",
                "dateembauche" => "2000-01-01",
                "basesalaire" => 500000,
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

        DB::table('chauffeur')->insert([
            [
                'employe_id' => '3',
                'permis' => 'PM544 054545 544',
                'expiration_c' => null,
                'expiration_d' => null,
                'expiration_e' => null,
            ],
            [
                'employe_id' => '4',
                'permis' => 'PM987 018780 545',
                'expiration_c' => '2019-05-26',
                'expiration_d' => '2019-05-26',
                'expiration_e' => '2019-05-26',
            ],
            [
                'employe_id' => '5',
                'permis' => 'PM987 87802521 545',
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

        DB::table('partenaire')->insert([
            [
                'raisonsociale' => 'Glamo Group',
                'comptecontribuable' => '54780-98988598-A',
                'telephone' => '+22589966602',
                'isclient' => true,
                'contact' => '[{"titre_c":"Will Koffi","type_c":"MOB","valeur_c":"5464545"},{"titre_c":"Will Koffi","type_c":"EMA","valeur_c":"w.koffi@pont-hkb.com"}]',
            ],
            [
                'raisonsociale' => 'MOHAM',
                'comptecontribuable' => '87026-66556055-K',
                'telephone' => '+2259562014',
                'isclient' => true,
                'contact' => '[{"titre_c":"Simon Kouakou","type_c":"MOB","valeur_c":"50466545"},{"titre_c":"Simon Kouakou","type_c":"EMA","valeur_c":"glamolondon@gmail.com"}]',
            ],
            [
                'raisonsociale' => 'MARCY',
                'comptecontribuable' => '65890-12120201-P',
                'telephone' => '+22589966602',
                'isclient' => true,
                'contact' => '[{"titre_c":"Touré Amadou","type_c":"MOB","valeur_c":"78996302"},{"titre_c":"Touré Amadou","type_c":"EMA","valeur_c":"glamolondon@live.fr"}]',
            ]
        ]);

        DB::table('famille')->insert([
            ['libelle' => 'Non définie']
        ]);

        DB::table('moyenreglement')->insert([
            ['libelle' => 'Espèce'],
            ['libelle' => 'Chèque'],
            ['libelle' => 'Orange Money'],
            ['libelle' => 'MTN Mobil Money'],
            ['libelle' => 'Moov Money (Flooz)'],
        ]);

        DB::table('vehicule')->insert([
            [
                'cartegrise' => '32146046545600',
                'immatriculation' => '2564FH01',
                'marque' => 'Ford',
                'visite' => '2017-12-05',
                'assurance' => '2017-11-23',
                'typecommercial' => 'Ranger',
                'couleur' => 'blanche',
                'energie' => 'Gaz-oil',
                'nbreplace' => 4,
                'puissancefiscale' => 10,
                'genre_id' => 2
            ],
            [
                'cartegrise' => '989980121213',
                'immatriculation' => '9601GP01',
                'marque' => 'Nissan',
                'visite' => '2017-06-13',
                'assurance' => '2017-10-25',
                'typecommercial' => 'Navara',
                'couleur' => 'blanche',
                'energie' => 'Gaz-oil',
                'nbreplace' => 4,
                'puissancefiscale' => 7,
                'genre_id' => 4
            ],
            [
                'cartegrise' => '32146046545600',
                'immatriculation' => '154FE01',
                'marque' => 'Nissan',
                'visite' => '2018-01-07',
                'assurance' => '2017-01-23',
                'typecommercial' => 'Urvan',
                'couleur' => 'blanche',
                'energie' => 'Gaz-oil',
                'nbreplace' => 23,
                'puissancefiscale' => 15,
                'genre_id' => 3
            ],
        ]);

        DB::table('produit')->insert([
            [
                "reference" => "000004",
                "libelle" => "ROTULE SUPERIEUR TROOPER",
                "prixunitaire" => 17450,
                "famille_id" => 1
            ],
            [
                "reference" => "000005",
                "libelle" => "JEUX DE PLAQUETTE DE FREINS TROOPER AV",
                "prixunitaire" => 33465,
                "famille_id" => 1
            ],
            [
                "reference" => "000006",
                "libelle" => "BIELLETTE DE DIRECTION TROOPER",
                "prixunitaire" => 12450,
                "famille_id" => 1
            ],
            [
                "reference" => "00001",
                "libelle" => "Amortisseur av ISUZU Trooper",
                "prixunitaire" => 17650,
                "famille_id" => 1
            ],
            [
                "reference" => "00002",
                "libelle" => "ROTULE DE INFERIEUR",
                "prixunitaire" => 21450,
                "famille_id" => 1
            ],
            [
                "reference" => "00007",
                "libelle" => "BIELLETTE DE SUSPENTION TROOPER",
                "prixunitaire" => 180430,
                "famille_id" => 1
            ],
            [
                "reference" => "00003",
                "libelle" => "Parallelisme des roues",
                "prixunitaire" => 3000,
                "famille_id" => 1
            ],
            [
                "reference" => "00008",
                "libelle" => "BIELLETTE DE SUSP AR TROOPER",
                "prixunitaire" => 130210,
                "famille_id" => 1
            ],
            [
                "reference" => "00009",
                "libelle" => "SEILENTBLOC DE BRAS SUP TROOPER",
                "prixunitaire" => 3455,
                "famille_id" => 1
            ],
            [
                "reference" => "0001",
                "libelle" => "DISAUE D''EMBRAYAGE TRACTEUR",
                "prixunitaire" => 475819,
                "famille_id" => 1
            ],
            [
                "reference" => "00010",
                "libelle" => "SOUFLET DE CARDANT TROOPER",
                "prixunitaire" => 6750,
                "famille_id" => 1
            ],
            [
                "reference" => "00010-10025716",
                "libelle" => "Pneus à carcasse radiale",
                "prixunitaire" => 125000,
                "famille_id" => 1
            ],
            [
                "reference" => "00011",
                "libelle" => "SEILENTBLOC DE BARRE STABILI TROOPER",
                "prixunitaire" => 6755,
                "famille_id" => 1
            ],
            [
                "reference" => "00012",
                "libelle" => "CROISILLON DE CARDAN TRANFER TROOPER",
                "prixunitaire" => 8760,
                "famille_id" => 1
            ],
            [
                "reference" => "00013",
                "libelle" => "TAMPONT DE CHASSIE AR TROOPER",
                "prixunitaire" => 60450,
                "famille_id" => 1
            ],
            [
                "reference" => "00014",
                "libelle" => "BOITE DE GRAISSE TROOPER",
                "prixunitaire" => 7000,
                "famille_id" => 1
            ],
            [
                "reference" => "00015",
                "libelle" => "Boite d''huile de direction",
                "prixunitaire" => 7000,
                "famille_id" => 1
            ],
            [
                "reference" => "00016",
                "libelle" => "Boite d''huile teracan",
                "prixunitaire" => 2000,
                "famille_id" => 1
            ],
            [
                "reference" => "00017",
                "libelle" => "Bidon d'huile moteur",
                "prixunitaire" => 9000,
                "famille_id" => 1
            ],
            [
                "reference" => "00019",
                "libelle" => "Reglage de pharre",
                "prixunitaire" => 3000,
                "famille_id" => 1
            ],
            [
                "reference" => "0002",
                "libelle" => "PALATEUX D''EMBRAYAGE TRACTEUR",
                "prixunitaire" => 778419,
                "famille_id" => 1
            ],
            [
                "reference" => "00020",
                "libelle" => "Pneus falken 245/70/16",
                "prixunitaire" => 147210,
                "famille_id" => 1
            ],
        ]);
    }
}
/*
('00020-10004950', 'Jante K7561-1913-0 KUBOTA', 48, 185321),
('00021', 'Litre carburan pour la visite', 35, 615),
('00022', 'Certifica de visite ', 3, 17000),
('00023', 'Vignette 2013', 4, 40000),
('00024', 'Maint d''oeuvre mecani', 4, 22000),
('00025', 'Klaxon ', 4, 3000),
('00026', 'Filtre a huile', 49, 9000),
('00027', 'Reglage de pharres', -1, 3000),
('00030-10024797', 'Triangle de sécurité de vehicule', 47, 25000),
('00040-10000318', 'Extincteur', 47, 85000),
('00050-10025871', 'Kit de remplacement de pneus FACOM', 47, 235000),
('001', ' AMORTISEUR AV L200', 0, 7500),
('0011', 'Croisillon de cardant tranfer', 0, 6000),
('0013', 'Tampont de chassie ar ', 0, 83510),
('0014', 'Boite de graisse ', 0, 2500),
('0015', 'BOITE D''HUILE DE FREINS', 50, 2000),
('00155', 'POMPE A INJECTION', 9, 3119475),
('0016', 'BOITE D''HUILE DE DIRECTION TROOPER', 50, 14000),
('0017', 'FILTRE A HUILE TROOPER', 50, 7000),
('0018', 'BIDON D''HUILE DE MOTEUR', 50, 9000),
('0019', 'PARALLESME DES ROUE', 5, 3000),
*/