<?php

namespace App\Http\Controllers;

use App\Models\Rechirp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RechirpController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Rechirp::class, 'rechirp');
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort_by' => ['nullable', 'string'],
            'sort_type' => ['nullable', 'string'],
        ]);

        $users = Rechirp::query();

        if(array_key_exists('page', $validated)){
            $users = $users
                ->orderBy($validated['sort_by'] ?? 'updated_at', $validated['sort_type'] ?? 'asc')
                ->paginate($validated['per_page'] ?? 25);
        }else{
            $users = $users->get();
        }
        return response()->json($users);
    }
}
