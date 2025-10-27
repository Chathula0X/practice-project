<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing suppliers if you want fresh data
        // Supplier::truncate(); // Uncomment this if you want to clear existing data
        
        // Create 50 suppliers with realistic data
        Supplier::factory(50)->create();
        
        $this->command->info('Created 50 suppliers successfully!');
    }
}