<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestAdminAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:test-auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test admin authentication';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing admin authentication...');
        
        // Get admin user
        $admin = Admin::where('email', 'admin@gmail.com')->first();
        
        if (!$admin) {
            $this->error('Admin user not found!');
            return;
        }
        
        $this->info('Admin user found: ' . $admin->name . ' (' . $admin->email . ')');
        
        // Test password verification
        $passwordValid = Hash::check('password', $admin->password);
        $this->info('Password verification: ' . ($passwordValid ? 'PASS' : 'FAIL'));
        
        // Test guard authentication
        $credentials = [
            'email' => 'admin@gmail.com',
            'password' => 'password'
        ];
        
        $authResult = Auth::guard('admins')->attempt($credentials);
        $this->info('Guard authentication: ' . ($authResult ? 'PASS' : 'FAIL'));
        
        if ($authResult) {
            $this->info('Authenticated admin: ' . Auth::guard('admins')->user()->name);
        }
    }
}
