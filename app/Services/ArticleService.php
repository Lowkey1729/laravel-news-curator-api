<?php

namespace App\Services;

use App\DTOs\FetchArticlesRequestData;
use App\Exceptions\ArticleException;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class ArticleService
{
    /**
     * @return array<string, mixed>
     */
    public function fetchArticles(FetchArticlesRequestData $data): array
    {
        return Article::query()
            ->when($data->title, function (Builder $query) use ($data) {
                $query->where('title', 'like', "$data->title%");
            })
            ->when($data->views, function (Builder $query) use ($data) {
                $query->where('views', $data->views);
            })
            ->when($data->clicks, function (Builder $query) use ($data) {
                $query->whereRelation('clicks', 'title', $data->clicks);
            })
            ->orderBy((string) $data->sort_by, $data->direction)
            ->paginate($data->limit)
            ->toArray();
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
