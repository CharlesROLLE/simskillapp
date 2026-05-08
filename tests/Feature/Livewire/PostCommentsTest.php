<?php

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $user = User::factory()->create();
    $this->post = Post::factory()
        ->for($user)
        ->has(PostComment::factory()->count(2), 'allPostComments')
        ->create();
});

it('guests can see comments and login prompt on show page', function () {
    $response = $this->get(route('posts.show', $this->post));

    $response->assertOk();
    $response->assertSee('login');
    $response->assertSee('register');
    $response->assertSee($this->post->allPostComments->first()->body);
});

it('guests cannot add a comment via livewire', function () {
    Livewire::test('post-comments', ['post' => $this->post])
        ->set('body', 'A new comment from guest')
        ->call('addComment')
        ->assertSet('body', 'A new comment from guest');

    expect(PostComment::count())->toBe(2);
});

it('guests cannot toggle like via livewire', function () {
    Livewire::test('post-comments', ['post' => $this->post])
        ->call('toggleLike')
        ->assertSet('userLikedId', null)
        ->assertSet('likesCount', 0);
});

it('authenticated user can add a comment', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('post-comments', ['post' => $this->post])
        ->set('body', 'This is a great post!')
        ->call('addComment')
        ->assertSet('body', '')
        ->assertSee('This is a great post!');

    expect(PostComment::count())->toBe(3);
});

it('authenticated user can reply to a comment', function () {
    $user = User::factory()->create();
    $comment = $this->post->allPostComments()->first();

    actingAs($user);

    Livewire::test('post-comments', ['post' => $this->post])
        ->call('startReply', $comment->id)
        ->assertSet('replyingTo', $comment->id)
        ->set('replyBody', 'This is a reply')
        ->call('addReply')
        ->assertSet('replyBody', '')
        ->assertSet('replyingTo', null);

    expect(PostComment::count())->toBe(3);
    expect(PostComment::where('parent_id', $comment->id)->exists())->toBeTrue();
});

it('authenticated user can toggle like', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('post-comments', ['post' => $this->post])
        ->call('toggleLike')
        ->assertSet('userLikedId', fn ($id) => $id !== null)
        ->assertSet('likesCount', 1);
});

it('authenticated user can unlike', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('post-comments', ['post' => $this->post])
        ->call('toggleLike')
        ->call('toggleLike')
        ->assertSet('userLikedId', null)
        ->assertSet('likesCount', 0);
});

it('authenticated user can delete own comment', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('post-comments', ['post' => $this->post])
        ->set('body', 'Comment to delete')
        ->call('addComment');

    $comment = PostComment::where('body', 'Comment to delete')->first();

    Livewire::test('post-comments', ['post' => $this->post])
        ->call('deleteComment', $comment->id);

    expect(PostComment::where('id', $comment->id)->exists())->toBeFalse();
});

it('authenticated user cannot delete others comment', function () {
    $user = User::factory()->create();
    $comment = $this->post->allPostComments()->first();

    actingAs($user);

    Livewire::test('post-comments', ['post' => $this->post])
        ->call('deleteComment', $comment->id);

    expect(PostComment::where('id', $comment->id)->exists())->toBeTrue();
});
