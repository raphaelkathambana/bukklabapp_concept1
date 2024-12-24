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
        Schema::create('club_members', function (Blueprint $table) {
            $table->foreignId('club_id')
                ->constrained('clubs')
                ->onDelete('cascade'); // FK to clubs
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // FK to users
            $table->enum('role', ['admin', 'member'])->default('member');
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamps();
            $table->primary(['club_id', 'user_id']); // Composite PK
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('club_members');
    }
};
