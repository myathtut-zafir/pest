<?php

test('user can get the list of products', function () {
    $product = \App\Models\Product::factory()->create();
    $response = $this->get('/api/products');

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                [
                    'id' => $product->id,
                    'name' => $product->name,
                ]
            ]
        ]);
})->only();
