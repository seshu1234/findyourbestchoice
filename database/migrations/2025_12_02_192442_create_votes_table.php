<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained('tools')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('ip')->nullable();
            $table->timestamps();

            // prevent duplicate votes for logged-in users
            $table->unique(['tool_id','user_id'], 'votes_tool_user_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
