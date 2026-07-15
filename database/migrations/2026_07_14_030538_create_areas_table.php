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
        Schema::create('areas', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('country_side_id')
                ->constrained('country_sides')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();

            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            $table->text('google_map_url')->nullable();

            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->text('open_hours')->nullable();
            $table->text('description')->nullable();
            $table->text('serves')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('title');
            $table->index('is_active');
            $table->index(['country_side_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};