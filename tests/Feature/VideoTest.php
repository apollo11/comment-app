<?php

use App\Models\User;
use App\Models\Video;

use function Pest\Faker\fake;

test('Create video', function () {

    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/video', [
            'title' => fake()->sentence,
            'video_url' => fake()->url,
        ]);

    $response->assertStatus(200);
});

test('Update video', function () {

    $user = User::factory()->create();
    $video = Video::factory()->create();

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->putJson("/api/v1/video/{$video->id}", [
            'title' => fake()->sentence,
            'video_url' => fake()->url,
        ]);

    $response->assertStatus(200);
});

test('Show Details video', function () {

    $user = User::factory()->create();
    $video = Video::factory()->create();

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->getJson("/api/v1/video/{$video->id}", [
            'title' => fake()->sentence,
            'video_url' => fake()->url,
        ]);

    $response->assertStatus(200);
});

test('Delete Details video', function () {

    $user = User::factory()->create();
    $video = Video::factory()->create();

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->deleteJson("/api/v1/video/{$video->id}", [
            'title' => fake()->sentence,
            'video_url' => fake()->url,
        ]);

    $response->assertStatus(200);
});

test('List Details video', function () {

    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->getJson('/api/v1/video');

    $response->assertStatus(200);
});
