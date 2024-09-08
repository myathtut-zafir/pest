<?php

use App\Models\Product;

test('user can get the list of products', function () {
    $product = Product::factory()->create();
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

test('user can get a product', function () {
    $product = Product::factory()->create();
    $this->getJson("/api/products/{$product->id}")
        ->assertStatus(200);

})->only();
