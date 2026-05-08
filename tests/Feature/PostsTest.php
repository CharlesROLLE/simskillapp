<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $tag = Tag::factory()->create();

    $this->post = Post::factory()
        ->for($user)
        ->for($category)
        ->hasAttached($tag)
        ->create();
});

it('guest can see posts index', function () {
    $response = $this->get(route('posts.index'));

    $response->assertOk();
    $response->assertSee($this->post->title);
    $response->assertSee($this->post->category->name);
    $response->assertSee('#'.$this->post->tags->first()->name);
});

it('guest can see post show page', function () {
    $response = $this->get(route('posts.show', $this->post));

    $response->assertOk();
    $response->assertSee($this->post->title);
    $response->assertSee($this->post->user->name);
    $response->assertSee($this->post->category->name);
    $response->assertSee('#'.$this->post->tags->first()->name);
});

it('post resolves by slug', function () {
    $response = $this->get(route('posts.show', $this->post));

    $response->assertOk();

    $slugRoute = route('posts.show', $this->post);
    expect($slugRoute)->toContain($this->post->slug);
});

it('post belongs to a user', function () {
    expect($this->post->user)->toBeInstanceOf(User::class);
});

it('post belongs to a category', function () {
    expect($this->post->category)->toBeInstanceOf(Category::class);
});

it('post has tags', function () {
    expect($this->post->tags)->toHaveCount(1);
    expect($this->post->tags->first())->toBeInstanceOf(Tag::class);
});
