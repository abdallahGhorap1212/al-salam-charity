<?php

namespace App\Repositories\Eloquent;

use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class NewsRepository extends BaseRepository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function latestPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->orderByDesc('published_at')->orderByDesc('id')->paginate($perPage);
    }

    public function published(int $limit = 10): Collection
    {
        return $this->query()->published()->orderByDesc('published_at')->orderByDesc('id')->limit($limit)->get();
    }

    public function publishedPaginated(int $perPage = 9): LengthAwarePaginator
    {
        return $this->query()->published()->orderByDesc('published_at')->orderByDesc('id')->paginate($perPage);
    }

    public function withImages(News $news): News
    {
        return $news->load('images');
    }
}
