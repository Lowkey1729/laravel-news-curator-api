<?php

namespace App\Http\Controllers;

use App\Responses\V1\SuccessResponse;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}

    public function index()
    {
        $data = $this->articleService->fetchArticles();

        return SuccessResponse::make(message: 'Articles fetched successfully', data: $data);
    }

    public function show()
    {
        $data = $this->articleService->fetchArticle(1);

        return SuccessResponse::make(message: 'Article fetched successfully', data: $data);
    }

    public function store()
    {
        $this->articleService->storeArticle();

        return SuccessResponse::make(message: 'Article stored successfully', statusCode: 201);
    }

    public function update()
    {
        $this->articleService->updateArticle(2);

        return SuccessResponse::make(message: 'Article updated successfully');
    }

    public function click()
    {
        $this->articleService->recordArticleClick(1);

        return SuccessResponse::make(message: 'Click recorded successfully');
    }
}
