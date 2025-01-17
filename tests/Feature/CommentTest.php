<?php

use App\Models\Comment;
use App\Models\CommentType;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;

use function Pest\Faker\fake;

test('Create comment to photo', function () {

    $user = User::factory()->create();
    $photo = Photo::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/comment', [
            'title' => fake()->sentence,
            'body' => fake()->paragraph,
            'comment_type' => 'photo',
            'photo_id' => $photo->id,
        ]);

    $response->assertStatus(200);
});

test('Create comment to video', function () {

    $user = User::factory()->create();
    $video = Video::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/comment', [
            'title' => fake()->sentence,
            'body' => fake()->paragraph,
            'comment_type' => 'video',
            'video_id' => $video->id,
        ]);

    $response->assertStatus(200);
});

test('Create comment to post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/comment', [
            'title' => fake()->sentence,
            'body' => fake()->paragraph,
            'comment_type' => 'post',
            'post_id' => $post->id,
        ]);

    $response->assertStatus(200);
});

test('Show Details comment', function () {

    $user = User::factory()->create();
    $photo = Photo::factory()->create();
    $type = CommentType::factory()->create();
    $comment = Comment::create([
        'body' => 'This is a comment.',
        'user_id' => $user->id,
        'comment_type_id' => $type->id,
        'commentable_id' => $photo->id,
        'commentable_type' => \App\Models\Support\Enum\MorphMapEnum::PHOTO->value,
    ]);

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->getJson("/api/v1/comment/{$comment->id}");

    $response->assertStatus(200);
});

test('Delete Details comment', function () {

    $user = User::factory()->create();
    $photo = Photo::factory()->create();
    $type = CommentType::factory()->create();
    $comment = Comment::create([
        'body' => 'This is a comment.',
        'user_id' => $user->id,
        'comment_type_id' => $type->id,
        'commentable_id' => $photo->id,
        'commentable_type' => \App\Models\Support\Enum\MorphMapEnum::PHOTO->value,
    ]);

    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->deleteJson("/api/v1/comment/{$comment->id}");

    $response->assertStatus(200);
});

test('List Details comment', function () {

    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->getJson('/api/v1/photo');

    $response->assertStatus(200);
});
