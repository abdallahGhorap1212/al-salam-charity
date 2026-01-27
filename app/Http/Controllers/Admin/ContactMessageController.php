<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ContactMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function __construct(private readonly ContactMessageService $contactMessageService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-contact-messages')->only(['index', 'show']);
        $this->middleware('permission:delete-contact-messages')->only(['destroy']);
    }

    public function index(): View
    {
        $messages = $this->contactMessageService->latestPaginated(20);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage): View
    {
        $this->contactMessageService->markAsRead($contactMessage);

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $this->contactMessageService->delete($contactMessage);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'تم حذف الرسالة.');
    }
}
