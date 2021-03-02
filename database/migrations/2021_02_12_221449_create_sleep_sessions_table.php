<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSleepSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sleep_sessions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start', $precision = 0)->nullable();
            $table->dateTime('end', $precision = 0)->nullable();
            $table->foreignId('day_id')->unique()->constrained('days');
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
        Schema::dropIfExists('sleep_sessions');
    }
}
