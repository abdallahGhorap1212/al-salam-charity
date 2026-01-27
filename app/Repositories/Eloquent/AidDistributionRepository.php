<?php

namespace App\Repositories\Eloquent;

use App\Models\AidDistribution;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AidDistributionRepository extends BaseRepository
{
    public function __construct(AidDistribution $model)
    {
        parent::__construct($model);
    }

    public function latestPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()->with('case')->latest()->paginate($perPage);
    }

    public function filterByDates(?string $from, ?string $to, int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->query()->with(['case', 'user'])->latest();

        if ($from) {
            $query->whereDate('distribution_date', '>=', $from);
        }

        if ($to) {
            $query->whereDate('distribution_date', '<=', $to);
        }

        return $query->paginate($perPage)->withQueryString();
    }
}
