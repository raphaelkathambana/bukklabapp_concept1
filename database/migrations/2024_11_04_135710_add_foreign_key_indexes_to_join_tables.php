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
        Schema::table('user_books', function (Blueprint $table) {
            $table->index('user_id', 'idx_user_books_user_id');
            $table->index('book_id', 'idx_user_books_book_id');
        });

        Schema::table('book_authors', function (Blueprint $table) {
            $table->index('book_id', 'idx_book_authors_book_id');
            $table->index('author_id', 'idx_book_authors_author_id');
        });

        Schema::table('book_genres', function (Blueprint $table) {
            $table->index('book_id', 'idx_book_genres_book_id');
            $table->index('genre_id', 'idx_book_genres_genre_id');
        });

        Schema::table('book_shelf_items', function (Blueprint $table) {
            $table->index('book_shelf_id', 'idx_book_shelf_items_shelf_id');
            $table->index('book_id', 'idx_book_shelf_items_book_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_books', function (Blueprint $table) {
            $table->dropIndex('idx_user_books_user_id');
            $table->dropIndex('idx_user_books_book_id');
        });

        Schema::table('book_authors', function (Blueprint $table) {
            $table->dropIndex('idx_book_authors_book_id');
            $table->dropIndex('idx_book_authors_author_id');
        });

        Schema::table('book_genres', function (Blueprint $table) {
            $table->dropIndex('idx_book_genres_book_id');
            $table->dropIndex('idx_book_genres_genre_id');
        });

        Schema::table('book_shelf_items', function (Blueprint $table) {
            $table->dropIndex('idx_book_shelf_items_shelf_id');
            $table->dropIndex('idx_book_shelf_items_book_id');
        });
    }
};
