<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChirpController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Chirp::class, 'chirp');
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort_by' => ['nullable', 'string'],
            'sort_type' => ['nullable', 'string'],
        ]);

        $users = Chirp::query();

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
     * Create a new chirp instance after a valid registration.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'author_id' => ['required', 'string', 'exists:users,id'],
            'content' => ['required', 'string', 'max:280']
        ]);

        $chirp = Chirp::create($validated);

        return response()->json($chirp, Response::HTTP_CREATED);
    }

    /**
     * Show a chirp.
     *
     * @param Chirp $chirp
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Chirp $chirp, Request $request)
    {
        return response()->json($chirp);
    }

    /**
     * Destroy a chirp.
     *
     * @param Chirp $chirp
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Chirp $chirp, Request $request)
    {
        return response()->json(null, $chirp->delete() ?
            Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }
}
