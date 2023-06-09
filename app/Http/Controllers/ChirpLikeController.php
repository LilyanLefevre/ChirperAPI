<?php

namespace App\Http\Controllers;

use App\Models\ChirpLike;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChirpLikeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ChirpLike::class, 'chirp_like');
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort_by' => ['nullable', 'string'],
            'sort_type' => ['nullable', 'string'],
        ]);

        $users = ChirpLike::query();

        if(array_key_exists('page', $validated)){
            $users = $users
                ->orderBy($validated['sort_by'] ?? 'updated_at', $validated['sort_type'] ?? 'asc')
                ->paginate($validated['per_page'] ?? 25);
        }else{
            $users = $users->get();
        }
        return response()->json($users);
    }

    /**
     * Show a chirp like.
     *
     * @param ChirpLike $chirp
     * @param Request $request
     * @return JsonResponse
     */
    public function show(ChirpLike $chirp_like, Request $request)
    {
        return response()->json($chirp_like);
    }

    /**
     * Create a new chirp like instance after a valid registration.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'chirp_id' => ['required', 'string', 'exists:chirps,id'],
            'user_id' => ['required', 'string', 'exists:users,id']
        ]);

        $chirp_like = ChirpLike::create($validated);

        return response()->json($chirp_like, Response::HTTP_CREATED);
    }

    /**
     * Destroy a chirp like.
     *
     * @param ChirpLike $chirp_like
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(ChirpLike $chirp_like, Request $request)
    {
        return response()->json(null, $chirp_like->delete() ?
            Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }
}
