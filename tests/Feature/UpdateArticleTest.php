<?php

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\ArticleRequestFixtures;

uses(ArticleRequestFixtures::class);
uses(RefreshDatabase::class);

test('it returns error when an invalid id is given', function () {
    $requestData = $this->updateArticle();

    $article = Article::factory()->create();

    $response = $this->putJson(route('v1.articles.update', ['id' => $article->id + 1]), $requestData);
    $response->assertStatus(404);

    $data = $response->json();

    expect($data)
        ->success->toBeFalse()
        ->message->toBeString()->toBe('Article not found')
        ->errors->toBeArray();
});

test('it successfully updates an article', function () {
    $requestData = $this->updateArticle();

    $article = Article::factory()->create();

    $response = $this->putJson(route('v1.articles.update', ['id' => $article->id]), $requestData);
    $response->assertStatus(200);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Article updated successfully');
});

test('it has the slug changed after updating the title of an article', function () {
    $requestData = $this->updateArticle();

    $article = Article::factory()->create(['title' => $requestData['title']]);

    $response = $this->putJson(route('v1.articles.update', ['id' => $article->id]), $requestData);
    $response->assertStatus(200);

    $data = $response->json();

    $updatedArticle = Article::query()->first();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Article updated successfully')
        ->and($updatedArticle)
        ->slug->not->toBe($article->slug);
});

test('it does not have the slug changed when the title of the article is not updated', function () {
    $requestData = $this->updateArticle();

    $article = Article::factory()->create();

    $response = $this->putJson(route('v1.articles.update', ['id' => $article->id]), ['url' => 'https://facebook.com']);
    $response->assertStatus(200);

    $data = $response->json();

    $updatedArticle = Article::query()->first();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Article updated successfully')
        ->and($updatedArticle)
        ->slug->toBe($article->slug);
});
