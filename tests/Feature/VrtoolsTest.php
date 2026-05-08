<?php

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vrtool;

beforeEach(function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $tag = Tag::factory()->create();

    $this->vrtool = Vrtool::factory()
        ->for($user)
        ->for($category)
        ->hasAttached($tag, [], 'tags')
        ->create();
});

it('guest can see vrtools index', function () {
    $response = $this->get(route('vrtools.index'));

    $response->assertOk();
    $response->assertSee($this->vrtool->title);
    $response->assertSee($this->vrtool->category->name);
    $response->assertSee('#'.$this->vrtool->tags->first()->name);
});

it('guest can see vrtool show page', function () {
    $response = $this->get(route('vrtools.show', $this->vrtool));

    $response->assertOk();
    $response->assertSee($this->vrtool->title);
    $response->assertSee($this->vrtool->user->name);
    $response->assertSee($this->vrtool->category->name);
    $response->assertSee('#'.$this->vrtool->tags->first()->name);
});

it('vrtool resolves by slug', function () {
    $response = $this->get(route('vrtools.show', $this->vrtool));

    $response->assertOk();

    $slugRoute = route('vrtools.show', $this->vrtool);
    expect($slugRoute)->toContain($this->vrtool->slug);
});

it('vrtool belongs to a user', function () {
    expect($this->vrtool->user)->toBeInstanceOf(User::class);
});

it('vrtool belongs to a category', function () {
    expect($this->vrtool->category)->toBeInstanceOf(Category::class);
});

it('vrtool has tags', function () {
    expect($this->vrtool->tags)->toHaveCount(1);
    expect($this->vrtool->tags->first())->toBeInstanceOf(Tag::class);
});
