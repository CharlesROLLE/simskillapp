<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('approaches', function (Blueprint $table) {
            $table->string('icao');
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->text('extract');
            $table->text('description');
            $table->string('image');
        });
    }

    public function down(): void
    {
        Schema::table('approaches', function (Blueprint $table) {
            $table->dropColumn(['icao', 'name', 'country', 'city', 'extract', 'description', 'image']);
        });
    }
};
