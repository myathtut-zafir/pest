<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

test('the application return a success response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});


