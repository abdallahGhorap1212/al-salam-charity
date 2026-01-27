<?php

namespace App\Repositories\Eloquent;

use App\Models\DonationRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DonationRequestRepository extends BaseRepository
{
    public function __construct(DonationRequest $model)
    {
        parent::__construct($model);
    }

    public function latestWithServicePaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->query()->with('service')->orderByDesc('created_at')->paginate($perPage);
    }
}
