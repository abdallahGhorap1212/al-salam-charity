<?php

namespace App\Services;

use App\Models\CaseType;
use App\Repositories\Eloquent\CaseTypeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CaseTypeService
{
    public function __construct(private readonly CaseTypeRepository $caseTypeRepository)
    {
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->caseTypeRepository->orderedPaginated($perPage);
    }

    public function orderedAll(): Collection
    {
        return $this->caseTypeRepository->orderedAll();
    }

    public function create(array $data, bool $isActive): CaseType
    {
        $data['is_active'] = $isActive;
        $data['code'] = $data['code'] ?? null;

        return $this->caseTypeRepository->create($data);
    }

    public function update(CaseType $caseType, array $data, bool $isActive): bool
    {
        $data['is_active'] = $isActive;
        $data['code'] = $data['code'] ?? null;

        return $this->caseTypeRepository->update($caseType, $data);
    }

    public function delete(CaseType $caseType): bool
    {
        return $this->caseTypeRepository->delete($caseType);
    }
}
