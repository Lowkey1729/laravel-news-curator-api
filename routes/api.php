<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
   Route::get('/articles', [ArticleController::class, 'index']);

   Route::post('/articles', [ArticleController::class, 'store']);

   Route::get('/articles/{id}', [ArticleController::class, 'show']);

   Route::put('/articles/{id}', [ArticleController::class, 'update']);

   Route::post('/articles/{id}/click', [ArticleController::class, 'click']);
});
