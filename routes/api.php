<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Photo\PhotoController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Video\VideoController;
use App\Models\Support\Enum\RouteEnum;
use Illuminate\Support\Facades\Route;

/**
 * Guest Routes
 */
Route::prefix('v1')->group(function (): void {

    Route::prefix('auth')->group(function (): void {
        Route::post('login', [LoginController::class, 'store'])->name(RouteEnum::LOGIN->value);
    });
});

/**
 * Authenticated Routes
 */
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function (): void {

    /**
     * Auth Routes
     */
    Route::prefix('auth')->group(function (): void {
        Route::post('logout', [LogoutController::class, 'store'])->name(RouteEnum::AUTH_LOGOUT->value);
    });

    /**q
     * Post Routes
     */
    Route::prefix('post')->group(function (): void {
        Route::post('', [PostController::class, 'store'])->name(RouteEnum::POST_CREATE->value);
        Route::put('/{post}', [PostController::class, 'update'])->name(RouteEnum::POST_UPDATE->value);
        Route::get('', [PostController::class, 'index'])->name(RouteEnum::POST_LIST->value);
        Route::get('/{post}', [PostController::class, 'show'])->name(RouteEnum::POST_SHOW->value);
        Route::delete('/{post}', [PostController::class, 'destroy'])->name(RouteEnum::POST_DELETE->value);
    });

    /**q
     * Video Routes
     */
    Route::prefix('video')->group(function (): void {
        Route::post('', [VideoController::class, 'store'])->name(RouteEnum::VIDEO_CREATE->value);
        Route::post('/comment/{video}', [VideoController::class, 'comment'])->name(RouteEnum::VIDEO_CREATE_COMMENT->value);
        Route::put('/{video}', [VideoController::class, 'update'])->name(RouteEnum::VIDEO_UPDATE->value);
        Route::get('', [VideoController::class, 'index'])->name(RouteEnum::VIDEO_LIST->value);
        Route::get('/{video}', [VideoController::class, 'show'])->name(RouteEnum::VIDEO_SHOW->value);
        Route::delete('/{video}', [VideoController::class, 'destroy'])->name(RouteEnum::VIDEO_DELETE->value);
    });

    /**q
     * Photo Routes
     */
    Route::prefix('photo')->group(function (): void {
        Route::post('', [PhotoController::class, 'store'])->name(RouteEnum::PHOTO_CREATE->value);
        Route::put('/{photo}', [PhotoController::class, 'update'])->name(RouteEnum::PHOTO_UPDATE->value);
        Route::get('', [PhotoController::class, 'index'])->name(RouteEnum::PHOTO_LIST->value);
        Route::get('/{photo}', [PhotoController::class, 'show'])->name(RouteEnum::PHOTO_SHOW->value);
        Route::delete('/{photo}', [PhotoController::class, 'destroy'])->name(RouteEnum::PHOTO_DELETE->value);
    });

    /**q
     * Comment Routes
     */
    Route::prefix('comment')->group(function (): void {
        Route::post('', [CommentController::class, 'store'])->name(RouteEnum::COMMENT_CREATE->value);
        Route::put('/{comment}', [CommentController::class, 'update'])->name(RouteEnum::COMMENT_UPDATE->value);
        Route::get('/{type}/{id}', [CommentController::class, 'index'])->name(RouteEnum::COMMENT_LIST->value);
        Route::get('/{comment}', [CommentController::class, 'show'])->name(RouteEnum::COMMENT_SHOW->value);
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name(RouteEnum::COMMENT_DELETE->value);
    });

});

Route::fallback(function () {
    return response()->json([
        'data' => [
            'message' => 'Page Not Found.',
        ],
    ], \Illuminate\Http\Response::HTTP_NOT_FOUND);
});
