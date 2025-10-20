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
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->constrained('inquiries')->onDelete('cascade');
            $table->string('version')->default('v1');
            $table->text('notes')->nullable();
            $table->string('title')->nullable();
            $table->string('destination')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->decimal('markup', 10, 2)->default(0);
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->unique('inquiry_id', 'version');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
