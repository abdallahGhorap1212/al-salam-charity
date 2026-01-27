<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use App\Services\BoardMemberService;
use App\Http\Requests\Admin\BoardMemberStoreRequest;
use App\Http\Requests\Admin\BoardMemberUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BoardMemberController extends Controller
{
    public function __construct(private readonly BoardMemberService $boardMemberService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-board-members')->only(['index']);
        $this->middleware('permission:create-board-members')->only(['create', 'store']);
        $this->middleware('permission:edit-board-members')->only(['edit', 'update']);
        $this->middleware('permission:delete-board-members')->only(['destroy']);
    }

    public function index(): View
    {
        $boardMembers = $this->boardMemberService->orderedPaginated(15);

        return view('admin.board-members.index', compact('boardMembers'));
    }

    public function create(): View
    {
        return view('admin.board-members.create');
    }

    public function store(BoardMemberStoreRequest $request): RedirectResponse
    {
        $this->boardMemberService->create($request->validated(), $request);

        return redirect()
            ->route('admin.board-members.index')
            ->with('success', 'تم إضافة عضو مجلس الإدارة بنجاح.');
    }

    public function edit(BoardMember $boardMember): View
    {
        return view('admin.board-members.edit', compact('boardMember'));
    }

    public function update(BoardMemberUpdateRequest $request, BoardMember $boardMember): RedirectResponse
    {
        $this->boardMemberService->update($boardMember, $request->validated(), $request);

        return redirect()
            ->route('admin.board-members.index')
            ->with('success', 'تم تحديث بيانات عضو مجلس الإدارة.');
    }

    public function destroy(BoardMember $boardMember): RedirectResponse
    {
        $this->boardMemberService->delete($boardMember);

        return redirect()
            ->route('admin.board-members.index')
            ->with('success', 'تم حذف عضو مجلس الإدارة.');
    }
}
