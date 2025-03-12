<?php

namespace App\Http\Controllers;

use App\Exceptions\ArticleException;
use App\Requests\CreateArticleRequest;
use App\Requests\FetchArticlesRequest;
use App\Requests\UpdateArticleRequest;
use App\Responses\V1\SuccessResponse;
use App\Services\ArticleService;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}

    /**
     * @throws InvalidDataClass
     */
    public function index(FetchArticlesRequest $request)
    {
        $data = $this->articleService->fetchArticles($request->getData());

        return SuccessResponse::make(message: 'Articles fetched successfully', data: $data);
    }

    /**
     * @throws ArticleException
     */
    public function show(int $id)
    {
        $data = $this->articleService->fetchArticleById($id);

        return SuccessResponse::make(message: 'Article fetched successfully', data: $data);
    }

    public function store(CreateArticleRequest $request)
    {
        $this->articleService->storeArticle($request->all());

        return SuccessResponse::make(message: 'Article created successfully', statusCode: 201);
    }

    /**
     * @throws ArticleException
     */
    public function update(int $id, UpdateArticleRequest $request)
    {
        $this->articleService->updateArticle(id: $id, data: $request->all());

        return SuccessResponse::make(message: 'Article updated successfully');
    }

    /**
     * @throws ArticleException
     */
    public function click(int $id)
    {
        $this->articleService->recordArticleClick($id);

        return SuccessResponse::make(message: 'Click recorded successfully');
    }
}
