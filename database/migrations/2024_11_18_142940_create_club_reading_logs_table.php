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
        Schema::create('club_reading_logs', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('club_id')
                ->constrained('clubs')
                ->onDelete('cascade'); // FK to clubs
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // FK to users
            $table->foreignId('book_id')
                ->constrained('books')
                ->onDelete('cascade'); // FK to books
            $table->integer('pages_read');
            $table->integer('reading_time'); // in minutes
            $table->text('notes')->nullable();
            $table->timestamp('logged_at');
            $table->timestamps();
            $table->index(['club_id', 'user_id', 'logged_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('club_reading_logs');
    }
};
