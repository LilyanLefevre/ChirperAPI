<?php

namespace App\Http\Controllers;

use App\Models\ChirpLike;
use Illuminate\Http\Request;

class ChirpLikeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ChirpLike::class, 'chirp_like');
    }
}
