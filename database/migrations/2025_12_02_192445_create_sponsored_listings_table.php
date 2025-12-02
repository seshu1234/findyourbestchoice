<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sponsored_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained('tools')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('amount', 12, 2)->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('placement')->default('homepage'); // homepage, category, search, newsletter...
            $table->string('slot_name')->nullable(); // eg: "homepage_top_1", "category_slot_2"
            $table->integer('priority')->default(0); // higher priority shows before lower
            $table->boolean('active')->default(true);
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['placement','active','starts_at','ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsored_listings');
    }
};
