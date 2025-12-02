<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('logo_url')->nullable();
            $table->json('images')->nullable();
            $table->decimal('price_from', 10, 2)->nullable();
            $table->string('affiliate_url')->nullable();
            $table->string('official_url')->nullable();
            $table->json('pros')->nullable();
            $table->json('cons')->nullable();
            $table->json('meta')->nullable();
            $table->unsignedInteger('upvotes')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // Indexes for common queries
            $table->index(['category_id', 'price_from']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
