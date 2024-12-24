<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('club_books', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('club_id')
                ->constrained('clubs')
                ->onDelete('cascade'); // FK to clubs
            $table->foreignId('book_id')
                ->constrained('books')
                ->onDelete('cascade'); // FK to books
            $table->timestamp('added_at')->useCurrent();
            $table->timestamps();
            $table->unique(['club_id', 'book_id']); // Unique constraint on club_id + book_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('club_books');
    }
};
