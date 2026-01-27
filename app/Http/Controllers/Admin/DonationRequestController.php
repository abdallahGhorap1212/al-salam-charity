<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use App\Services\DonationRequestService;
use App\Http\Requests\Admin\DonationRequestUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DonationRequestController extends Controller
{
    public function __construct(private readonly DonationRequestService $donationRequestService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-donation-requests')->only(['index', 'show']);
        $this->middleware('permission:edit-donation-requests')->only(['edit', 'update']);
        $this->middleware('permission:delete-donation-requests')->only(['destroy']);
    }

    public function index(): View
    {
        $requests = $this->donationRequestService->latestPaginated(20);

        return view('admin.donation-requests.index', compact('requests'));
    }

    public function show(DonationRequest $donationRequest): View
    {
        return view('admin.donation-requests.show', compact('donationRequest'));
    }

    public function edit(DonationRequest $donationRequest): View
    {
        return view('admin.donation-requests.edit', compact('donationRequest'));
    }

    public function update(DonationRequestUpdateRequest $request, DonationRequest $donationRequest): RedirectResponse
    {
        $this->donationRequestService->updateStatus($donationRequest, $request->validated()['status']);

        return redirect()
            ->route('admin.donation-requests.index')
            ->with('success', 'تم تحديث حالة طلب التبرع.');
    }

    public function destroy(DonationRequest $donationRequest): RedirectResponse
    {
        $this->donationRequestService->delete($donationRequest);

        return redirect()
            ->route('admin.donation-requests.index')
            ->with('success', 'تم حذف طلب التبرع.');
    }
}
