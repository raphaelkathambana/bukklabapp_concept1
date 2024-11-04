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
        Schema::create('reading_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->integer('pages_read')->unsigned();
            $table->integer('reading_time')->unsigned()->comment('in minutes');
            $table->text('notes')->nullable();
            $table->timestamp('logged_at');
            $table->timestamps();

            // Index for efficient date-based queries
            $table->index(['user_id', 'logged_at'], 'idx_user_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_logs');
    }
};
