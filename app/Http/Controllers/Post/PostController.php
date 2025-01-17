<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use App\Models\Support\Enum\ResponseMessage;
use App\Models\Support\Traits\HasPaginatedInput;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use HasPaginatedInput;

    /**
     * The default order by column.
     */
    public const DEFAULT_ORDER_BY = 'posts.created_at';

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $qb = Post::query();

        $qb->with(['user', 'comments']);

        $qb->orderBy($this->getOrderBy(self::DEFAULT_ORDER_BY), $this->getDirectionInput()->value);

        $result = $qb->paginate($this->getPerPageInput() ?? 20, 'posts.*', $this->getPageInput() ?? 1);

        return response()->json($result, Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostStoreRequest  $request
     * @return JsonResponse
     */
    public function store(PostStoreRequest $request): JsonResponse
    {
        $query = new Post($request->validated());
        $query->user()
            ->associate(Auth::user())
            ->save();

        return response()->json([
            'result' => $query,
            'message' => ResponseMessage::CREATE_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);

    }

    /**
     *  Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post->load('user', 'comments'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post): JsonResponse
    {
        $post->fill($request->validated());
        $post->user()
            ->associate(Auth::user())
            ->save();

        return response()->json([
            'result' => $post,
            'message' => ResponseMessage::PUT_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        return response()->json([
            'result' => $post->delete(),
            'message' => ResponseMessage::DELETE_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);
    }
}
