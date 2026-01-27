<?php

namespace App\Services;

use App\Models\Area;
use App\Repositories\Eloquent\AreaRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AreaService
{
    public function __construct(private readonly AreaRepository $areaRepository)
    {
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->areaRepository->orderedPaginated($perPage);
    }

    public function orderedAll(): Collection
    {
        return $this->areaRepository->orderedAll();
    }

    public function create(array $data, bool $isActive): Area
    {
        $data['is_active'] = $isActive;
        $data['code'] = $data['code'] ?? null;

        return $this->areaRepository->create($data);
    }

    public function update(Area $area, array $data, bool $isActive): bool
    {
        $data['is_active'] = $isActive;
        $data['code'] = $data['code'] ?? null;

        return $this->areaRepository->update($area, $data);
    }

    public function delete(Area $area): bool
    {
        return $this->areaRepository->delete($area);
    }
}
