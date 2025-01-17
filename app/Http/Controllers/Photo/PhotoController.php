<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\PhotoStoreRequest;
use App\Http\Requests\Photo\PhotoUpdateRequest;
use App\Models\Photo;
use App\Models\Support\Enum\ResponseMessage;
use App\Models\Support\Traits\HasPaginatedInput;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    use HasPaginatedInput;

    /**
     * The default order by column.
     */
    public const DEFAULT_ORDER_BY = 'photos.created_at';

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $qb = Photo::query();

        $qb->with(['user', 'comments']);

        $qb->orderBy($this->getOrderBy(self::DEFAULT_ORDER_BY), $this->getDirectionInput()->value);

        $result = $qb->paginate($this->getPerPageInput() ?? 20, 'photos.*', $this->getPageInput() ?? 1);

        return response()->json($result, Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PhotoStoreRequest  $request
     * @return JsonResponse
     */
    public function store(PhotoStoreRequest $request): JsonResponse
    {
        $disk = Storage::disk('local');

        $filename = strtolower(str_replace(' ', '-', $request->title)).'.png'; // create a filename

        $filePath = 'photos/'.$filename; // create a file path

        if ($disk->exists($filePath)) { // if the file exists
            $disk->delete($filePath);
        }

        $disk->put($filePath, base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $request->image))); // save the image

        $query = new Photo([
            'title' => $request->title,
            'image_url' => $disk->url($filePath),
        ]);
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
     *
     * @param  Photo  $photo
     * @return JsonResponse
     */
    public function show(Photo $photo): JsonResponse
    {
        return response()->json($photo->load('user', 'comments'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PhotoUpdateRequest  $request
     * @param  Photo  $photo
     * @return JsonResponse
     */
    public function update(PhotoUpdateRequest $request, Photo $photo): JsonResponse
    {
        $photo->fill($request->validated());
        $photo->user()
            ->associate(Auth::user())
            ->save();

        return response()->json([
            'result' => $photo,
            'message' => ResponseMessage::PUT_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Photo  $photo
     * @return JsonResponse
     */
    public function destroy(Photo $photo): JsonResponse
    {
        return response()->json([
            'result' => $photo->delete(),
            'message' => ResponseMessage::DELETE_SUCCESS->value,
            'errors' => null,
        ], Response::HTTP_OK);
    }
}
