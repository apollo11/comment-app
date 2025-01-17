<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Faker\fake;

test('Create POST', function () {

    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/post', [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
        ]);

    $response->assertStatus(200);
});

test('Update POST', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->putJson("/api/v1/post/{$post->id}", [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
        ]);

    $response->assertStatus(200);
});

test('Show Details POST', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->getJson("/api/v1/post/{$post->id}", [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
        ]);

    $response->assertStatus(200);
});

test('Delete Details POST', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->deleteJson("/api/v1/post/{$post->id}", [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
        ]);

    $response->assertStatus(200);
});

test('List Details POST', function () {

    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->getJson('/api/v1/post');

    $response->assertStatus(200);
});
