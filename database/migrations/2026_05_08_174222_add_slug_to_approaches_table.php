<?php

use App\Models\Approach;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('approaches', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('image');
        });

        Approach::query()->eachById(function (Approach $approach) {
            $approach->slug = Str::slug($approach->icao.'-'.$approach->name);
            $approach->save();
        });

        Schema::table('approaches', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('approaches', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
