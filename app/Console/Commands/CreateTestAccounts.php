<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:create-test-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test admin and user accounts for development';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating test accounts...');
        $this->newLine();

        // Create Admin Account
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->info('✓ Admin account created successfully!');
        } else {
            $this->info('✓ Admin account already exists!');
        }

        // Create User Account
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Test User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if ($user->wasRecentlyCreated) {
            $this->info('✓ User account created successfully!');
        } else {
            $this->info('✓ User account already exists!');
        }

        $this->newLine();
        $this->info('=== LOGIN CREDENTIALS ===');
        $this->newLine();
        
        $this->info('ADMIN LOGIN:');
        $this->line('URL: ' . url('/admin/login'));
        $this->line('Email: admin@gmail.com');
        $this->line('Password: password');
        $this->newLine();

        $this->info('USER LOGIN:');
        $this->line('URL: ' . url('/login'));
        $this->line('Email: user@gmail.com');
        $this->line('Password: password');
        $this->newLine();

        $this->info('USER REGISTRATION:');
        $this->line('URL: ' . url('/register'));
        $this->newLine();

        return Command::SUCCESS;
    }
}

