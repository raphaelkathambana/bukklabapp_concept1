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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('creator_user_id')
                ->constrained('users')
                ->onDelete('cascade'); // FK to users, cascade on delete
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Adds deleted_at column for soft deletion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('clubs');
    }
};
