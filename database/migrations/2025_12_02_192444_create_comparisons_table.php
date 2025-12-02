<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_a_id')->constrained('tools')->cascadeOnDelete();
            $table->foreignId('tool_b_id')->constrained('tools')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->json('comparison_data')->nullable();
            $table->longText('content')->nullable();
            $table->json('meta')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['tool_a_id','tool_b_id'], 'unique_tools_pair');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comparisons');
    }
};
