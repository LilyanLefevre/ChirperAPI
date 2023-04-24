<?php

namespace App\Http\Controllers;

use App\Models\Rechirp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

        $rechirp = Rechirp::create($validated);

        return response()->json($rechirp, Response::HTTP_CREATED);
    }

    /**
     * Show a rechirp.
     *
     * @param Rechirp $rechirp
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Rechirp $rechirp, Request $request)
    {
        return response()->json($rechirp);
    }

    /**
     * Destroy a rechirp.
     *
     * @param Rechirp $rechirp
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Rechirp $rechirp, Request $request)
    {
        return response()->json(null, $rechirp->delete() ?
            Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }
}
