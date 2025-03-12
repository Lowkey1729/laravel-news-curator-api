<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\ArticleRequestFixtures;

uses(ArticleRequestFixtures::class);
uses(RefreshDatabase::class);

test('it validates request', function () {
    $response = $this->postJson(route('v1.articles.store'), []);
    $response->assertStatus(422);

    $data = $response->json();

    expect($data)
        ->success->toBeFalse()
        ->message->toBeString()
        ->errors->toBeArray();
});

test('it creates article successfully', function () {
    $requestData = $this->createArticleData();
    $response = $this->postJson(route('v1.articles.store'), $requestData);
    $response->assertStatus(201);

    $data = $response->json();

    expect($data)
        ->success->toBeTrue()
        ->message->toBeString()->toBe('Article created successfully');
});
