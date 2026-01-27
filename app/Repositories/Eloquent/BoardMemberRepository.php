<?php

namespace App\Repositories\Eloquent;

use App\Models\BoardMember;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BoardMemberRepository extends BaseRepository
{
    public function __construct(BoardMember $model)
    {
        parent::__construct($model);
    }

    public function active(int $limit = null): Collection
    {
        $query = $this->query()->active()->orderBy('sort_order')->orderBy('name');

        if ($limit) {
            return $query->limit($limit)->get();
        }

        return $query->get();
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->orderBy('sort_order')->orderBy('name')->paginate($perPage);
    }
}
