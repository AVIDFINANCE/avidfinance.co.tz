<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo plan if none exists
        $plan = Plan::first();
        if (!$plan) {
            $plan = Plan::create([
                'name' => 'Demo Plan',
                'price' => 0,
                'features' => json_encode(['Demo features']),
                'max_users' => 10,
                'max_clients' => 100,
            ]);
        }

        // Create or get demo tenant
        $tenant = Tenant::firstOrCreate(
            ['slug' => 'phidtech-demo'],
            [
                'name' => 'PhidTech Demo Organization',
                'contact_email' => 'admin@phidtech.com',
                'phone' => '+1234567890',
                'status' => 'active',
                'plan_id' => $plan->id,
                'trial_ends_at' => now()->addDays(3),
            ]
        );

        // Demo users removed - use SuperAdminSeeder for the admin account
    }
}
