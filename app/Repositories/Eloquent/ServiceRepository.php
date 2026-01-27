<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ServiceRepository extends BaseRepository
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function active(int $limit = null): Collection
    {
        $query = $this->query()->active()->orderBy('sort_order')->orderBy('title');

        if ($limit) {
            return $query->limit($limit)->get();
        }

        return $query->get();
    }

    public function activePaginated(int $perPage = 8): LengthAwarePaginator
    {
        return $this->query()->active()->orderBy('sort_order')->orderBy('title')->paginate($perPage);
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->orderBy('sort_order')->orderBy('title')->paginate($perPage);
    }
}
