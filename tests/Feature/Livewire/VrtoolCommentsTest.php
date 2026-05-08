<?php

use App\Models\User;
use App\Models\Vrtool;
use App\Models\VrtoolComment;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $user = User::factory()->create();
    $this->vrtool = Vrtool::factory()
        ->for($user)
        ->has(VrtoolComment::factory()->count(2), 'allVrtoolComments')
        ->create();
});

it('guests can see comments and login prompt on show page', function () {
    $response = $this->get(route('vrtools.show', $this->vrtool));

    $response->assertOk();
    $response->assertSee('login');
    $response->assertSee('register');
    $response->assertSee($this->vrtool->allVrtoolComments->first()->body);
});

it('guests cannot add a comment via livewire', function () {
    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->set('body', 'A new comment from guest')
        ->call('addComment')
        ->assertSet('body', 'A new comment from guest');

    expect(VrtoolComment::count())->toBe(2);
});

it('guests cannot toggle like via livewire', function () {
    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->call('toggleLike')
        ->assertSet('userLikedId', null)
        ->assertSet('likesCount', 0);
});

it('authenticated user can add a comment', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->set('body', 'This is a great article!')
        ->call('addComment')
        ->assertSet('body', '')
        ->assertSee('This is a great article!');

    expect(VrtoolComment::count())->toBe(3);
});

it('authenticated user can reply to a comment', function () {
    $user = User::factory()->create();
    $comment = $this->vrtool->allVrtoolComments()->first();

    actingAs($user);

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->call('startReply', $comment->id)
        ->assertSet('replyingTo', $comment->id)
        ->set('replyBody', 'This is a reply')
        ->call('addReply')
        ->assertSet('replyBody', '')
        ->assertSet('replyingTo', null);

    expect(VrtoolComment::count())->toBe(3);
    expect(VrtoolComment::where('parent_id', $comment->id)->exists())->toBeTrue();
});

it('authenticated user can toggle like', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->call('toggleLike')
        ->assertSet('userLikedId', fn ($id) => $id !== null)
        ->assertSet('likesCount', 1);
});

it('authenticated user can unlike', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->call('toggleLike')
        ->call('toggleLike')
        ->assertSet('userLikedId', null)
        ->assertSet('likesCount', 0);
});

it('authenticated user can delete own comment', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->set('body', 'Comment to delete')
        ->call('addComment');

    $comment = VrtoolComment::where('body', 'Comment to delete')->first();

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->call('deleteComment', $comment->id);

    expect(VrtoolComment::where('id', $comment->id)->exists())->toBeFalse();
});

it('authenticated user cannot delete others comment', function () {
    $user = User::factory()->create();
    $comment = $this->vrtool->allVrtoolComments()->first();

    actingAs($user);

    Livewire::test('vrtool-comments', ['vrtool' => $this->vrtool])
        ->call('deleteComment', $comment->id);

    expect(VrtoolComment::where('id', $comment->id)->exists())->toBeTrue();
});
