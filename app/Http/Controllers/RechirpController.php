<?php

namespace App\Http\Controllers;

use App\Models\Rechirp;
use Illuminate\Http\Request;

class RechirpController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Rechirp::class, 'rechirp');
    }
}
