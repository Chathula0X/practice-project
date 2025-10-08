<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if admin already exists
        $existingAdmin = Admin::where('email', 'admin@gmail.com')->first();
        
        if ($existingAdmin) {
            $this->info('Admin user already exists:');
            $this->line('Email: ' . $existingAdmin->email);
            $this->line('Name: ' . $existingAdmin->name);
            
            // Update password to ensure it's correct
            $existingAdmin->password = Hash::make('password');
            $existingAdmin->save();
            $this->info('Password updated to: password');
        } else {
            // Create new admin user
            $admin = Admin::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
            
            $this->info('Admin user created successfully:');
            $this->line('Email: ' . $admin->email);
            $this->line('Password: password');
        }
    }
}