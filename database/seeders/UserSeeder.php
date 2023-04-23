<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(20)->create();
        User::updateOrCreate([
            'name' => 'Lilyan',
            'last_name' => 'BG',
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);
    }
}
