<?php

namespace Database\Seeders;

use App\Models\ChirpLike;
use Illuminate\Database\Seeder;

class ChirpLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChirpLike::factory()->count(20)->create();
    }
}
