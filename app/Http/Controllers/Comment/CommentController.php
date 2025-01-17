<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\CommentType;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Support\Enum\ResponseMessage;
use App\Models\Support\Traits\HasPaginatedInput;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use HasPaginatedInput;

    /**
     * The default order by column.
     */
    public const DEFAULT_ORDER_BY = 'comments.created_at';

    /**
     * Display a listing of the resource.
     *
     * @param  $type
     * @param  $id
     * @return JsonResponse
     */
    public function index($type, $id): JsonResponse
    {
        $qb = Comment::query();
        $qb->with(['user', 'commentType', 'commentable']);
        $qb->whereHas('commentType', function ($query) use ($type) {
            $query->where('name', $type);
        });
        $qb->whereHas('commentable', function ($query) use ($id) {
            $query->where('commentable_id', $id);
        });
        $qb->orderBy($this->getOrderBy(self::DEFAULT_ORDER_BY), $this->getDirectionInput()->value);

        $result = $qb->paginate($this->getPerPageInput() ?? 20, 'comments.*', $this->getPageInput() ?? 1);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentStoreRequest  $request
     * @return JsonResponse
     */
    public function store(CommentStoreRequest $request): JsonResponse
    {
        $commentType = CommentType::where('name', 'video')->first(); // get the comment type

        $commentableModel = match ($request->comment_type) { // get the commentable model
            'video' => Video::findOrFail($request->video_id),
            'post' => Post::findOrFail($request->post_id),
            'photo' => Photo::findOrFail($request->photo_id),
            default => throw new \InvalidArgumentException('Invalid comment type'),
        };

        $comment = new Comment($request->validated()); // create a new comment
        $comment->commentable()->associate($commentableModel); // morph to the commentable model
        $comment->user()->associate(Auth::user()); // associate the user
        $comment->commentType()->associate($commentType); // associate the comment type
        $comment->save();

        return response()->json([
            'result' => $comment,
            'message' => ResponseMessage::CREATE_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);

    }

    /**
     * Display the specified resource.
     *
     * @param  Comment  $comment
     * @return JsonResponse
     */
    public function show(Comment $comment): JsonResponse
    {
        return response()->json($comment->load('user', 'commentType', 'commentable'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentUpdateRequest  $request
     * @param  Comment  $comment
     * @return void
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment  $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        return response()->json([
            'result' => $comment->delete(),
            'message' => ResponseMessage::DELETE_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);

    }
}
