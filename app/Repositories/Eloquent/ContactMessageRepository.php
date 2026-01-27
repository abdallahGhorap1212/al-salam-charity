<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactMessageRepository extends BaseRepository
{
    public function __construct(ContactMessage $model)
    {
        parent::__construct($model);
    }

    public function latestPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->query()->orderByDesc('created_at')->paginate($perPage);
    }
}
