<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->after('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title')->after('category_id');
            $table->string('slug')->after('title')->unique();
            $table->text('body')->after('slug');
            $table->string('image')->after('body');
            $table->timestamp('published_at')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn(['title', 'slug', 'body', 'image', 'published_at']);
        });
    }
};
