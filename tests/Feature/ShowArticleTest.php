<?php

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\ArticleRequestFixtures;

uses(RefreshDatabase::class);
uses(ArticleRequestFixtures::class);

test('it returns error response when an article is not found', function () {
    $response = $this->getJson(route('v1.articles.show', ['id' => 1]));
    $response->assertStatus(404);

    $data = $response->json();

    expect($data)
        ->success->toBeFalse()
        ->message->toBeString()->toBe('Article not found');
});

test('it successfully returns details of an article', function () {

    $article = Article::factory()->create();

    $response = $this->getJson(route('v1.articles.show', ['id' => $article->id]));
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Article fetched successfully')
        ->data->toBeArray()
        ->and($data['data'])
        ->id->toBe($article->id)
        ->title->toBe($article->title)
        ->slug->toBe($article->slug)
        ->content->toBe($article->content);
});
