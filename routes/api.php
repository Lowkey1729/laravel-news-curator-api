<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('v1.articles.index');

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('v1.articles.store');

    Route::get('/articles/{id}', [ArticleController::class, 'show'])
        ->name('v1.articles.show');

    Route::put('/articles/{id}', [ArticleController::class, 'update'])
        ->name('v1.articles.update');

    Route::post('/articles/{id}/click', [ArticleController::class, 'click'])
        ->name('v1.articles.click');
});
