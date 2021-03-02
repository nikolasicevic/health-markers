<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_sessions', function (Blueprint $table) {
            $table->id();
            $table->decimal('duration_hrs', 4, 2)->nullable();
            $table->enum('intensity', ['high', 'medium', 'low']);
            $table->foreignId('activity_id')->constrained('activities');
            $table->foreignId('day_id')->constrained('days');
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
        Schema::dropIfExists('activity_sessions');
    }
}
