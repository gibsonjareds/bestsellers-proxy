<?php

namespace App\Http\Controllers;

use App\Http\Clients\NytClient;
use App\Http\Requests\NytBookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class NytController extends Controller
{
    public NytClient $client;
    public function __construct(){
        $this->client = new NytClient();
    }
    public function get(NytBookRequest $request): JsonResponse{

        $response = $this->client->getBestSellers($request->validated());

        if($response->ok())
            return response()->json($response->json());

        if($response->status() === 429)
            return response()->json(['message' => "Too many requests, try again later"], 429);

        if($response->status() >= 500)
            return response()->json(['message' => 'Error with upstream server'], 503);

        return response()->json(['message' => 'Unknown error'], 500);
    }
}
