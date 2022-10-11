<?php

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

test('Should return 200 if login was executed successfully', function() {
    $testUser = User::factory()->create();
    $response = $this->postJson('/api/authenticate', [
        'email' => $testUser->email,
        'password' => '123456'
    ]);
    $data = $response->decodeResponseJson()->json();
    $response->assertStatus(Response::HTTP_OK);
    expect($data['messages'])->toContain(__('authentication.success'));
    expect(Arr::get($data, 'data.user.id'))->toBe($testUser->id);
});

test('Should return 400 if login was executed with wrong params', function() {
    $response = $this->postJson('/api/authenticate', [
        'wrong_params' => 0 
    ]);
    $response->assertStatus(Response::HTTP_BAD_REQUEST);
});

test('Should return 401 if login was executed with wrong credentials', function() {
    $testUser = User::factory()->create();
    $response = $this->postJson('/api/authenticate', [
        'email' => $testUser->email, 
        'password' => 'wrong_password'
    ]);
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('Should return 500 if login was executed with internal server error', function() {
    $testUser = User::factory()->create();
    $response = $this->postJson('/api/authenticate', [
        'email' => $testUser->email, 
        'password' => 'wrong_password'
    ]);
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});

