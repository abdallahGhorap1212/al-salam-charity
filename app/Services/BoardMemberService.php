<?php

namespace App\Services;

use App\Models\BoardMember;
use App\Repositories\Eloquent\BoardMemberRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class BoardMemberService
{
    public function __construct(private readonly BoardMemberRepository $boardMemberRepository)
    {
    }

    public function active(int $limit = null): Collection
    {
        return $this->boardMemberRepository->active($limit);
    }

    public function orderedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->boardMemberRepository->orderedPaginated($perPage);
    }

    public function create(array $data, Request $request): BoardMember
    {
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['photo'] = null;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('board-members', 'public');
        }

        return $this->boardMemberRepository->create($data);
    }

    public function update(BoardMember $boardMember, array $data, Request $request): bool
    {
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['photo'] = $boardMember->photo;

        if ($request->boolean('remove_photo')) {
            $this->deletePhoto($boardMember->photo);
            $data['photo'] = null;
        }

        if ($request->hasFile('photo')) {
            $this->deletePhoto($boardMember->photo);
            $data['photo'] = $request->file('photo')->store('board-members', 'public');
        }

        return $this->boardMemberRepository->update($boardMember, $data);
    }

    public function delete(BoardMember $boardMember): bool
    {
        $this->deletePhoto($boardMember->photo);

        return $this->boardMemberRepository->delete($boardMember);
    }

    private function deletePhoto(?string $photo): void
    {
        if (! $photo) {
            return;
        }

        Storage::disk('public')->delete($photo);
    }
}
