<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Support\Enum\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * This method is used to log out the user.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => ResponseMessage::LOGOUT_SUCCESS->value,
        ], Response::HTTP_OK);
    }
}
