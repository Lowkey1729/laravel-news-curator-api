<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles.index');

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    Route::get('/articles/{id}', [ArticleController::class, 'show'])
        ->name('articles.show');

    Route::put('/articles/{id}', [ArticleController::class, 'update'])
        ->name('articles.update');

    Route::post('/articles/{id}/click', [ArticleController::class, 'click'])
        ->name('articles.click');
});
