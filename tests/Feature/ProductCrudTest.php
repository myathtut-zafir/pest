<?php

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

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

test('guess user can not create product', function () {
    $product = Product::factory()->raw();
    $this->postJson('/api/products', $product)
        ->assertStatus(401);
    $this->assertDatabaseCount('products', 0);
})->only();

test('auth user can not create product', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $data = Product::factory()->raw();
    $this->postJson('/api/products', $data)->assertStatus(201);

    $this->assertDatabaseCount('products', 1);
    $this->assertDatabaseHas('products', $data);

})->only();
test('guess not update', function () {

    $product = Product::factory()->create();
    $data = Product::factory()->raw();

    $this->putJson("/api/products/{$product->id}", $data)
        ->assertStatus(401);

    $this->assertDatabaseHas('products', $product->toArray());
})->only();

test('auth user can update', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $product = Product::factory()->create();
    $data = Product::factory()->raw();

    $this->putJson("/api/products/{$product->id}", $data)
        ->assertStatus(200);

    $this->assertDatabaseHas('products', $data);

})->only();
