<?php

namespace Tests\Fixtures;

trait ArticleRequestFixtures
{
    /**
     * @return array{title: string, content: string}
     */
    public function createArticleData(): array
    {
        return [
            'title' => 'Article title',
            'content' => 'Article content is tested',
            'url' => 'http://google.com',
        ];
    }

    public function updateArticle(): array
    {
        return [
            'title' => 'Article title',
        ];
    }
}
