<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Onderdeel extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('onderdeel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sjabloon_id');
            $table->integer('parent_id')->nullable();
            
            // Een kolom voor de volgorde.
            // Als je een onderdeel tussen twee anderen zet is het een simpele
            // kwestie van alle hoger gelegen onderdelen de volgorde met 1
            // verhogen. Dit is een relatief dure manier maar gezien het aantal
            // verwachtte onderdelen per parent zal het meevallen.
            $table->integer('volgorde')->default(1);
            $table->string('naam')->nullable();
            $table->string('soort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('onderdeel');
    }

}
