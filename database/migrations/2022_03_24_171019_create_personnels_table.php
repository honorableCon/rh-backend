<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string("cni");
            $table->string("prenom");
            $table->string("nom");
            $table->date("naissance");
            $table->string("sexe");
            $table->string("nationalite");
            $table->string("telephone");
            $table->string("email");
            $table->integer("enfant");
            $table->integer("conjoint");
            $table->timestamps();
            $table->foreignId('filiere_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnels');
    }
}
