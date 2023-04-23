<?php

namespace Database\Seeders;

use App\Models\TrendingTopic;
use Illuminate\Database\Seeder;

class TrendingTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrendingTopic::factory()->count(20)->create();
    }
}
