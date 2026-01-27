<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Repositories\Eloquent\ContactMessageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactMessageService
{
    public function __construct(private readonly ContactMessageRepository $contactMessageRepository)
    {
    }

    public function latestPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->contactMessageRepository->latestPaginated($perPage);
    }

    public function create(array $data): ContactMessage
    {
        return $this->contactMessageRepository->create($data);
    }

    public function markAsRead(ContactMessage $contactMessage): void
    {
        if (! $contactMessage->is_read) {
            $this->contactMessageRepository->update($contactMessage, ['is_read' => true]);
        }
    }

    public function delete(ContactMessage $contactMessage): bool
    {
        return $this->contactMessageRepository->delete($contactMessage);
    }
}
