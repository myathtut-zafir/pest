<?php

namespace Tests\Feature;

use App\Models\User;

test('invalid email or password', function () {

    $this->postJson('/api/login', [
        'email' => 'invalid-email@email.com',
        'password' => 'invalid-password',
    ])->assertStatus(422);

})->only();
test('valid email or password', function () {
    User::factory()->create([
        'email' => 'aa@gmail.com',
        'password' => '12345678',
    ]);

    $this->postJson('/api/login', [
        'email' => 'aa@gmail.com',
        'password' => '12345678',
    ])->assertStatus(204);

})->only();


