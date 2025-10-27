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
        Schema::table('itineraries', function (Blueprint $table) {
            $table->json('accommodation')->nullable()->after('end_date');
            $table->json('transport')->nullable()->after('accommodation');
            $table->json('activities')->nullable()->after('transport');
            $table->decimal('accommodation_total', 10, 2)->default(0)->after('activities');
            $table->decimal('transport_total', 10, 2)->default(0)->after('accommodation_total');
            $table->decimal('activities_total', 10, 2)->default(0)->after('transport_total');
            $table->json('timeline')->nullable()->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itineraries', function (Blueprint $table) {
            $table->dropColumn(['accommodation', 'transport', 'activities', 'accommodation_total', 'transport_total', 'activities_total', 'timeline']);
        });
    }
};
