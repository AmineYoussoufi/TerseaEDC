<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@minicrm.com',
            'password' => 'password',
            'societe_id' => 0,
            'type' => "administrateur",
            'status' => "vérifié"
        ]);
    }
}
