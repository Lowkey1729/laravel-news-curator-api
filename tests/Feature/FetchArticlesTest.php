<?php

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\ArticleRequestFixtures;

uses(ArticleRequestFixtures::class);
uses(RefreshDatabase::class);

test('it fetches all articles successfully', function () {
    Article::factory()->create();

    $response = $this->getJson(route('v1.articles.index'));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Articles fetched successfully')
        ->data->toBeArray();
});

test('it applies a limit of 30 articles per page', function () {
    Article::factory()->create();

    $response = $this->getJson(route('v1.articles.index', ['limit' => 30]));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Articles fetched successfully')
        ->data->toBeArray()
        ->and($data['data'])
        ->per_page->toBe(30);
});

test('it filters articles by title', function () {
    $title = 'Voyager 1';
    $article1 = Article::factory()->create(compact('title'));

    $response = $this->getJson(route('v1.articles.index', compact('title')));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Articles fetched successfully')
        ->data->toBeArray()
        ->and(collect($data['data']['data'])->first())
        ->id->toBe($article1->id)
        ->slug->toBe($article1->slug);
});

test('it filters articles by number of views', function () {
    $views = 5;
    $article1 = Article::factory()->create(compact('views'));

    $response = $this->getJson(route('v1.articles.index', compact('views')));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Articles fetched successfully')
        ->data->toBeArray()
        ->and(collect($data['data']['data'])->first())
        ->views->toBe($article1->views);
});

test('it filters articles by number of clicks', function () {
    $clicks = 100;
    $article = Article::factory()->create(compact('clicks'));

    $response = $this->getJson(route('v1.articles.index', compact('clicks')));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Articles fetched successfully')
        ->data->toBeArray()
        ->and(collect($data['data']['data'])->first())
        ->clicks->toBe($article->clicks);
});

test('it paginates articles and fetches the correct page', function () {
    Article::factory()->count(40)->create();

    $page = 4;
    $response = $this->getJson(route('v1.articles.index', compact('page')));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Articles fetched successfully')
        ->data->toBeArray()
        ->and($data['data'])
        ->current_page->toBe($page);
});
