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
            $table->char('province_id', 2);
            $table->char('regency_id', 4);
            $table->char('district_id', 7);
            $table->string('name');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('opening_hours');
            $table->string('closing_hours');
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
