<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('weather_histories', function (Blueprint $table) {

            $table->string('recommended_time')
                ->nullable()
                ->after('recommendation');

        });
    }

    public function down(): void
    {
        Schema::table('weather_histories', function (Blueprint $table) {

            $table->dropColumn('recommended_time');

        });
    }
};