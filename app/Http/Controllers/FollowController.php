<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort_by' => ['nullable', 'string'],
            'sort_type' => ['nullable', 'string'],
        ]);

        $users = Follow::query();

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
            'follower_id' => ['required', 'string', 'exists:users,id'],
            'followed_id' => ['required', 'string', 'exists:users,id']
        ]);

        $existing_follow = Follow::query()->where('follower_id', '=', $validated['follower_id'])
            ->where('followed_id', '=', $validated['followed_id'])->first();

        if(!empty($existing_follow)){
            return response()->json(['error' => ['message' => 'Following relationship already exists.']],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $follow = Follow::create($validated);

        return response()->json($follow, Response::HTTP_CREATED);
    }

    /**
     * Destroy a chirp like.
     *
     * @param Follow $follow
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Follow $follow, Request $request)
    {
        return response()->json(null, $follow->delete() ?
            Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }
}
