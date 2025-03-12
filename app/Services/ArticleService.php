<?php

namespace App\Services;

use App\Exceptions\ArticleException;
use App\Models\Article;

class ArticleService
{
    public function fetchArticles(): array
    {
        return Article::query()->simplePaginate(15)->toArray();
    }

    /**
     * @throws ArticleException
     */
    public function fetchArticleById(int $id): array
    {
        $article = Article::query()->first($id);
        if (! $article) {
            throw new ArticleException(message: 'Article not found', code: 404);
        }

        return $article->toArray();
    }

    public function storeArticle(): void {}

    /**
     * @throws ArticleException
     */
    public function updateArticle(int $id): void
    {
        $article = Article::query()->first($id);
        if (! $article) {
            throw new ArticleException(message: 'Article not found', code: 404);
        }
    }

    /**
     * @throws ArticleException
     */
    public function recordArticleClick(int $id): void
    {
        $article = Article::query()->first($id);
        if (! $article) {
            throw new ArticleException(message: 'Article not found', code: 404);
        }
    }
}
