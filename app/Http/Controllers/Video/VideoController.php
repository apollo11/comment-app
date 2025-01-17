<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoStoreRequest;
use App\Http\Requests\Video\VideoUpdateRequest;
use App\Models\Support\Enum\ResponseMessage;
use App\Models\Support\Traits\HasPaginatedInput;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    use HasPaginatedInput;

    /**
     * The default order by column.
     */
    public const DEFAULT_ORDER_BY = 'videos.created_at';

    /**
     * Display a listing of the resource.
     */
    public function index(): jsonResponse
    {
        $qb = Video::query();

        $qb->with(['user', 'comments']);

        $qb->orderBy($this->getOrderBy(self::DEFAULT_ORDER_BY), $this->getDirectionInput()->value);

        $result = $qb->paginate($this->getPerPageInput() ?? 20, 'videos.*', $this->getPageInput() ?? 1);

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoStoreRequest $request): JsonResponse
    {
        $query = new Video($request->validated());
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
     * Display the specified resource.
     */
    public function show(Video $video): JsonResponse
    {
        return response()->json($video->load('user', 'comments'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoUpdateRequest $request, Video $video): JsonResponse
    {
        $video->fill($request->validated());
        $video->user()
            ->associate(Auth::user())
            ->save();

        return response()->json([
            'result' => $video,
            'message' => ResponseMessage::PUT_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);
    }

    /**
     * This method is used to remove the specified resource from storage.
     */
    public function destroy(Video $video): JsonResponse
    {
        return response()->json([
            'result' => $video->delete(),
            'message' => ResponseMessage::DELETE_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);
    }
}
