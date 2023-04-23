<?php

namespace App\Http\Controllers;

use App\Models\TrendingTopic;
use Illuminate\Http\Request;

class TrendingTopicController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TrendingTopic::class, 'trending_topic');
    }
}
