<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->id();
            $table->string('oebb_id')->index();
            $table->time('departure_time_planned')->nullable();
            $table->string('train_number')->nullable();
            $table->string('destination_station')->nullable();
            $table->string('track')->nullable();
            $table->boolean('track_changed')->nullable();
            $table->boolean('cancelled')->nullable();
            $table->time('departure_time_est')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('timestamp_planned')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journeys');
    }
};
