<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::firstOrCreate([
            'email' => 'admin@portal.cig.chat',
        ],[
            'name' => 'Admin',
            'password' => Hash::make('admin@321'),
            'is_admin' => true,
            'company_name' => '',
            'license' => '',
            'phone' => '',
        ]);

        $plans = ['Business +Plus','Business','Start+ Plus','BASIC + PLUS'];
        foreach($plans as $plan_name){
            $plan = Plan::firstOrCreate([
                'name' => $plan_name,
                'price' => 100
            ]);

            $plan->features()->create([
                'feature_name' => "500GB Cloud Space",
                'description' => null,
            ]);
            $plan->features()->create([
                'feature_name' => "Team Collaboration",
                'description' => null,
            ]);
            $plan->features()->create([
                'feature_name' => "Project Management",
                'description' => null,
            ]);
            $plan->features()->create([
                'feature_name' => "Instant Chat",
                'description' => null,
            ]);
        }
    }
}
