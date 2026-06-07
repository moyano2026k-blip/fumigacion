<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(
            'weather_histories',
            function (Blueprint $table) {

                $table->string('rain_status')
                    ->nullable();

                $table->string('level')
                    ->nullable();

                $table->string('crop_status')
                    ->nullable();

                $table->string('temperature_status')
                    ->nullable();

            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'weather_histories',
            function (Blueprint $table) {

                $table->dropColumn([
                    'rain_status',
                    'level',
                    'crop_status',
                    'temperature_status'
                ]);

            }
        );
    }
};
