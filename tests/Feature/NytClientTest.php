<?php

use App\Http\Clients\NytClient;
use Illuminate\Support\Facades\Http;

test('it makes a request', function () {
    Http::fake();
    $client = new NytClient();
    $response = $client->getBestSellers();
    expect($response->status())->toEqual(200);
});
