<?php

namespace App\Http\Controllers;

use App\Models\TrendingTopic;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TrendingTopicController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TrendingTopic::class, 'trending_topic');
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort_by' => ['nullable', 'string'],
            'sort_type' => ['nullable', 'string'],
        ]);

        $users = TrendingTopic::query();

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
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255']
        ]);

        $trending_topic = TrendingTopic::create($validated);

        return response()->json($trending_topic, Response::HTTP_CREATED);
    }

    /**
     * Destroy a trending topic.
     *
     * @param TrendingTopic $trending_topic
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(TrendingTopic $trending_topic, Request $request)
    {
        return response()->json(null, $trending_topic->delete() ?
            Response::HTTP_NO_CONTENT : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
