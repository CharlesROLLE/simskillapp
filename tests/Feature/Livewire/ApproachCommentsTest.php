<?php

use App\Models\Approach;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->approach = Approach::factory()
        ->has(Comment::factory()->count(2), 'allComments')
        ->create();
});

it('guests can see comments and login prompt on show page', function () {
    $response = $this->get(route('approaches.show', $this->approach));

    $response->assertOk();
    $response->assertSee('login');
    $response->assertSee('register');
    $response->assertSee($this->approach->comments->first()->body);
});

it('guests cannot add a comment via livewire', function () {
    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->set('body', 'A new comment from guest')
        ->call('addComment')
        ->assertSet('body', 'A new comment from guest');

    expect(Comment::count())->toBe(2);
});

it('guests cannot toggle like via livewire', function () {
    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->call('toggleLike')
        ->assertSet('userLikedId', null)
        ->assertSet('likesCount', 0);

    expect(Like::count())->toBe(0);
});

it('authenticated user can add a comment', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->set('body', 'This is a great approach!')
        ->call('addComment')
        ->assertSet('body', '')
        ->assertSee('This is a great approach!');

    expect(Comment::count())->toBe(3);
});

it('authenticated user can reply to a comment', function () {
    $user = User::factory()->create();
    $comment = $this->approach->allComments()->first();

    actingAs($user);

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->call('startReply', $comment->id)
        ->assertSet('replyingTo', $comment->id)
        ->set('replyBody', 'This is a reply')
        ->call('addReply')
        ->assertSet('replyBody', '')
        ->assertSet('replyingTo', null);

    expect(Comment::count())->toBe(3);
    expect(Comment::where('parent_id', $comment->id)->exists())->toBeTrue();
});

it('authenticated user can toggle like', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->call('toggleLike')
        ->assertSet('userLikedId', fn ($id) => $id !== null)
        ->assertSet('likesCount', 1);

    expect(Like::count())->toBe(1);
});

it('authenticated user can unlike', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->call('toggleLike')
        ->call('toggleLike')
        ->assertSet('userLikedId', null)
        ->assertSet('likesCount', 0);

    expect(Like::count())->toBe(0);
});

it('authenticated user can delete own comment', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->set('body', 'Comment to delete')
        ->call('addComment');

    $comment = Comment::where('body', 'Comment to delete')->first();

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->call('deleteComment', $comment->id);

    expect(Comment::where('id', $comment->id)->exists())->toBeFalse();
});

it('authenticated user cannot delete others comment', function () {
    $user = User::factory()->create();
    $comment = $this->approach->allComments()->first();

    actingAs($user);

    Livewire::test('approach-comments', ['approach' => $this->approach])
        ->call('deleteComment', $comment->id);

    expect(Comment::where('id', $comment->id)->exists())->toBeTrue();
});
