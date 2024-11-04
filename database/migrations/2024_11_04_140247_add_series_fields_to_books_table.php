<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('series_id')->nullable()->constrained('books')->onDelete('set null')->after('published_date');
            $table->integer('series_order')->unsigned()->nullable()->after('series_id');
            $table->softDeletes()->after('updated_at'); // Adds deleted_at column for soft deletes
            $table->index('title', 'idx_books_title'); // Adds an index on the title column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['series_id']);
            $table->dropColumn(['series_id', 'series_order', 'deleted_at']);
            $table->dropIndex('idx_books_title');
        });
    }
};
