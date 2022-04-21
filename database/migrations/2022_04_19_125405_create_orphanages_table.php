<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphanages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('latitude');
            $table->string('longtitude');
            $table->string('opening_hours');
            $table->string('closed_hours');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orphanages');
    }
};
