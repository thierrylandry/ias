<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseIas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("service", function(Blueprint $table){
            $table->increments("id");
            $table->string("code",5);
            $table->string("libelle");
        });
        Schema::create("employe", function(Blueprint $table){
            $table->increments("id");
            $table->string("matricule",5);
            $table->string("nom",30);
            $table->string("prenoms",60)->nullable();
            $table->string('contact')->nullable();
            $table->date("datenaissance");
            $table->date("dateembauche");
            $table->date("datesortie")->nullable();
            $table->integer("basesalaire");
            $table->string("pieceidentite");
            $table->integer("service_id",false,true);
            $table->foreign("service_id")->references("id")->on("service");
        });
        Schema::create("utilisateur", function(Blueprint $table){
            $table->integer("employe_id",true,true);
            $table->string("login")->unique();
            $table->rememberToken();
            $table->string("password");
            $table->string("satut",3)->default(\App\Statut::TYPE_UTILISATEUR.\App\Statut::ETAT_ACTIF.\App\Statut::AUTRE_NON_DEFINI);
            $table->foreign("employe_id")->references("id")->on("employe");
        });
        Schema::create("chauffeur",function (Blueprint $table){
            $table->unsignedInteger('employe_id');
            $table->string('permis');
            $table->date('expiration_c')->nullable();
            $table->date('expiration_d')->nullable();
            $table->date('expiration_e')->nullable();
            $table->foreign("employe_id")->references("id")->on("employe");
        });
        Schema::create("typeintervention",function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create("genre",function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create("vehicule",function (Blueprint $table){
            $table->increments("id");
            $table->string("cartegrise");
            $table->string("immatriculation");
            $table->string('marque')->nullable();
            $table->date('visite');
            $table->date('assurance');
            $table->string('typecommercial');
            $table->string('couleur')->nullable();
            $table->string('energie')->nullable();
            $table->integer('nbreplace')->default(5);
            $table->integer('puissancefiscale')->nullable();
            $table->unsignedInteger('genre_id');
            $table->foreign("genre_id")->references("id")->on("genre");
        });
        Schema::create("intervention",function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('debut');
            $table->dateTime('fin');
            $table->integer('cout');
            $table->text('details')->nullable();
            $table->unsignedInteger('typeintervention_id');
            $table->unsignedInteger('vehicule_id');
            $table->foreign("vehicule_id")->references("id")->on("vehicule");
            $table->foreign("typeintervention_id")->references("id")->on("typeintervention");
        });
        Schema::create("moyenreglement",function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create("partenaire",function (Blueprint $table){
            $table->increments('id');
            $table->string('raisonsociale');
            $table->string('comptecontribuable')->nullable();
            $table->boolean('isclient')->default(true);
            $table->boolean('isfournisseur')->default(false);
            $table->text('contact')->nullable();
        });
        Schema::create("reglement",function (Blueprint $table){
            $table->increments('id');
            $table->string('reference');
            $table->dateTime('datereglement');
            $table->integer('montant');
            $table->string('details')->nullable();
            $table->unsignedInteger('partenaire_id');
            $table->unsignedInteger('moyenreglement_id');
            $table->foreign('partenaire_id','fk_reglement_partenaire')->references('id')->on('partenaire');
            $table->foreign('moyenreglement_id','fk_reglement_moyreglmt')->references('id')->on('moyenreglement');
        });
        Schema::create("mission",function (Blueprint $table){
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('destination');
            $table->date('debutprogramme');
            $table->date('debuteffectif');
            $table->date('finprogramme');
            $table->date('fineffective');
            $table->string('observation');
            $table->integer('perdiem');
            $table->integer('soldeperdiem')->default(0);
            $table->boolean('soustraite')->default(false);
            $table->unsignedInteger('chauffeur_id');
            $table->unsignedInteger('vehicule_id');
            $table->unsignedInteger('client');
            $table->unsignedInteger('soustraitant')->nullable();
            $table->foreign('chauffeur_id')->references('employe_id')->on('chauffeur');
            $table->foreign('vehicule_id')->references('id')->on('vehicule');
            $table->foreign('client')->references('id')->on('partenaire');
            $table->foreign('soustraitant')->references('id')->on('partenaire');
        });
        Schema::create("famille",function (Blueprint $table){
            $table->increments('id');
            $table->string('libelle');
        });
        Schema::create("produit",function (Blueprint $table){
            $table->increments('id');
            $table->string('reference')->unique();
            $table->string('libelle');
            $table->unsignedInteger('famille_id');
            $table->foreign('famille_id')->references('id')->on('famille');
        });
        Schema::create("piececomptable",function (Blueprint $table){
            $table->increments('id');
            $table->string('referencebc');
            $table->string('referencebl')->nullable();
            $table->string('referencefacture')->nullable();
            $table->dateTime('creationbc');
            $table->dateTime('creationbl')->nullable();
            $table->dateTime('creationfacture')->nullable();
            $table->string('etat')->default('BC'); //BC - BL - FACT
            $table->integer('montantht');
            $table->float('remise',3,2)->default(1.00);
            $table->float('tva',3,2)->default(0.18);
            $table->boolean('isexonere');
            $table->unsignedInteger('partenaire_id');
            $table->foreign('partenaire_id')->references('id')->on('partenaire');
        });
        Schema::create("lignepiece",function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('designation');
            $table->integer('prixunitaire');
            $table->string('modele');
            $table->integer('modele_id');
            $table->integer('quantite');
            $table->integer('quantitelivree')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lignepiece');
        Schema::dropIfExists('piececomptable');
        Schema::dropIfExists('produit');
        Schema::dropIfExists('famille');
        Schema::dropIfExists('mission');
        Schema::dropIfExists('reglement');
        Schema::dropIfExists('partenaire');
        Schema::dropIfExists('moyenreglement');
        Schema::dropIfExists('intervention');
        Schema::dropIfExists('typeintervention');
        Schema::dropIfExists('vehicule');
        Schema::dropIfExists('genre');
        Schema::dropIfExists('typeintervention');
        Schema::dropIfExists('chauffeur');
        Schema::dropIfExists('utilisateur');
        Schema::dropIfExists('employe');
        Schema::dropIfExists('service');
    }
}