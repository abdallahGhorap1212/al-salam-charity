<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\Eloquent\ServiceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    public function __construct(private readonly ServiceRepository $serviceRepository)
    {
    }

    public function active(int $limit = null): Collection
    {
        return $this->serviceRepository->active($limit);
    }

    public function activePaginated(int $perPage = 8): LengthAwarePaginator
    {
        return $this->serviceRepository->activePaginated($perPage);
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->serviceRepository->orderedPaginated($perPage);
    }

    public function create(array $data, Request $request): Service
    {
        $data['slug'] = $data['slug'] ?? null;
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['icon'] = null;

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('services', 'public');
        }

        return $this->serviceRepository->create($data);
    }

    public function update(Service $service, array $data, Request $request): bool
    {
        $data['slug'] = $data['slug'] ?? null;
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['icon'] = $service->icon;

        if ($request->hasFile('icon')) {
            $this->deleteIcon($service->icon);
            $data['icon'] = $request->file('icon')->store('services', 'public');
        }

        return $this->serviceRepository->update($service, $data);
    }

    public function delete(Service $service): bool
    {
        $this->deleteIcon($service->icon);

        return $this->serviceRepository->delete($service);
    }

    private function deleteIcon(?string $icon): void
    {
        if (! $icon) {
            return;
        }

        Storage::disk('public')->delete($icon);
    }
}
