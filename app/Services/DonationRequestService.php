<?php

namespace App\Services;

use App\Models\DonationRequest;
use App\Repositories\Eloquent\DonationRequestRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DonationRequestService
{
    public function __construct(private readonly DonationRequestRepository $donationRequestRepository)
    {
    }

    public function latestPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->donationRequestRepository->latestWithServicePaginated($perPage);
    }

    public function create(array $data): DonationRequest
    {
        $data['service_id'] = empty($data['service_id']) ? null : $data['service_id'];
        $data['amount'] = empty($data['amount']) ? null : $data['amount'];

        return $this->donationRequestRepository->create($data);
    }

    public function updateStatus(DonationRequest $donationRequest, string $status): bool
    {
        return $this->donationRequestRepository->update($donationRequest, ['status' => $status]);
    }

    public function delete(DonationRequest $donationRequest): bool
    {
        return $this->donationRequestRepository->delete($donationRequest);
    }
}
