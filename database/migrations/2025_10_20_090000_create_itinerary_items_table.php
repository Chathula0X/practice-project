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
        if (Schema::hasTable('itinerary_items')) {
            return;
        }
        Schema::create('itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_day_id')->constrained('itinerary_days')->onDelete('cascade');
            $table->enum('type', ['transport', 'stay', 'activity', 'fees']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('details')->nullable();
            $table->decimal('quantity', 8, 2)->default(1);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('tax_fees', 10, 2)->default(0);
            $table->decimal('markup', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_items');
    }
};


