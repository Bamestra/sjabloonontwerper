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
            $table->integer('prev_id')->nullable();
            $table->integer('next_id')->nullable();
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
