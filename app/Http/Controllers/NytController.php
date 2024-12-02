<?php

namespace App\Http\Controllers;

use App\Http\Requests\NytBookRequest;
use Illuminate\Http\JsonResponse;

class NytController extends Controller
{
    public function get(NytBookRequest $request): JsonResponse{
        return response()->json([]);
    }
}
