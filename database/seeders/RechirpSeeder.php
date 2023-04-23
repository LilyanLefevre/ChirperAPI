<?php

namespace Database\Seeders;

use App\Models\Rechirp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RechirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rechirp::factory()->count(20)->create();
    }
}
