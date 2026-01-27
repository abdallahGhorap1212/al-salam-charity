<?php

namespace App\Repositories\Eloquent;

use App\Models\CaseModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CaseRepository extends BaseRepository
{
    public function __construct(CaseModel $model)
    {
        parent::__construct($model);
    }

    public function search(?string $search, int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->query()->with(['area', 'caseType', 'files'])->latest();

        if ($search) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('case_number', 'like', "%{$search}%")
                    ->orWhere('national_id', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function latestWithRelations()
    {
        return $this->query()->with(['area', 'caseType'])->latest()->get();
    }

    public function allWithRelations()
    {
        return $this->query()->with(['area', 'caseType'])->get();
    }
}
