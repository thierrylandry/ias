<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Iasdatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("statut", function(Blueprint $table){
            $table->increments("id");
            $table->string("code",5);
            $table->string("libelle");
        });
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
            $table->date("datenaissance");
            $table->string("pieceidentite");
            $table->date("dateembauche");
            $table->date("datesortie")->nullable();
            $table->integer("basesalaire");
            $table->integer("service_id",false,true);
            $table->foreign("service_id")->references("id")->on("service");
        });
        Schema::create("utilisateur", function(Blueprint $table){
            $table->increments("id");
            $table->string("login")->unique();
            $table->rememberToken();
            $table->string("password");
            $table->integer("satut_id",false,true);
            $table->integer("employe_id",false,true);
            $table->foreign("satut_id")->references("id")->on("satut");
            $table->foreign("employe_id")->references("id")->on("employe");
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
        Schema::dropIfExists('statut');
        Schema::dropIfExists('service');
        Schema::dropIfExists('employe');
        Schema::dropIfExists('utilisateur');
    }
}
