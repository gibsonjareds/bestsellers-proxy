<?php

test('the endpoint returns a response', function () {
    $response = $this->get('/api/1/nyt/best-sellers');

    $response->assertStatus(200);
});
