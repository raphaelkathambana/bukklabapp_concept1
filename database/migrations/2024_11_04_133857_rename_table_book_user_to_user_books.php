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
        Schema::rename("book_user", "user_books");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename("user_books", "book_user");
    }
};
