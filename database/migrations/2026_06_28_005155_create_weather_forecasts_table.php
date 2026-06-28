<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('location_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('temperature', 5, 2);

            $table->integer('humidity');

            $table->decimal('pressure', 6, 2);

            $table->decimal('wind_speed', 5, 2);

            $table->string('weather_condition');

            $table->timestamp('prediction_date');

            $table->string('api_source')->default('OpenWeather');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
