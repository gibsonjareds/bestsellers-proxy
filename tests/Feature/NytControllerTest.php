<?php

use Illuminate\Support\Facades\Http;

test('it returns a response', function () {
    Http::fake([
        'api.nytimes.com/svc/books/v3/*' => Http::response(['message' => 'Ok'], 200)
    ]);
    $response = $this->getJson('/api/1/nyt/best-sellers');

    $response->assertStatus(200);
});

test('it returns a 429 when 3rd party throttles', function(){
    Http::fake([
        'api.nytimes.com/svc/books/v3/*' => Http::response(['message'=>"Too many requests"], 429)
    ]);
    $response = $this->getJson('/api/1/nyt/best-sellers');
    $response->assertStatus(429);
});

test('it handles a 500 from third party', function(){
    Http::fake([
        'api.nytimes.com/svc/books/v3/*' => Http::response(['message' => 'Server error'], 500)
    ]);
    $response = $this->getJson('/api/1/nyt/best-sellers');
    $response->assertStatus(503);
});

test('it errors on incorrect length ISBN', function(){
    $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=234');
    $response->assertStatus(422)->assertJson(['errors'=>['isbn.0' => ['The isbn.0 value must be exactly 10 or 13 characters']]]);
});

test('it errors on invalid characters in ISBN', function(){
    $response = $this->getJson('/api/1/nyt/best-sellers?isbn[]=0441172abc');
    $response->assertStatus(422)->assertJson(['errors'=>['isbn.0' => ['The isbn.0 must only contain numbers and the - character']]]);
});
test('it errors when offset is not a multiple of 20', function(){
    $response = $this->getJson('/api/1/nyt/best-sellers?offset=10');
    $response->assertStatus(422)->assertJson(['errors'=>['offset' =>['offset must be a multiple of 20']]]);
});
