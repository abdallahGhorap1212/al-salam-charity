<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseType;
use App\Services\CaseTypeService;
use App\Http\Requests\Admin\CaseTypeStoreRequest;
use App\Http\Requests\Admin\CaseTypeUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CaseTypeController extends Controller
{
    public function __construct(private readonly CaseTypeService $caseTypeService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-case-types')->only(['index']);
        $this->middleware('permission:create-case-types')->only(['create', 'store']);
        $this->middleware('permission:edit-case-types')->only(['edit', 'update']);
        $this->middleware('permission:delete-case-types')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $caseTypes = $this->caseTypeService->orderedPaginated(15);

        return view('admin.case-types.index', compact('caseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.case-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaseTypeStoreRequest $request): RedirectResponse
    {
        $this->caseTypeService->create($request->validated(), $request->boolean('is_active'));

        return redirect()
            ->route('admin.case-types.index')
            ->with('success', 'تم إضافة نوع الحالة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CaseType $caseType): View
    {
        return view('admin.case-types.show', compact('caseType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseType $caseType): View
    {
        return view('admin.case-types.edit', compact('caseType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CaseTypeUpdateRequest $request, CaseType $caseType): RedirectResponse
    {
        $this->caseTypeService->update($caseType, $request->validated(), $request->boolean('is_active'));

        return redirect()
            ->route('admin.case-types.index')
            ->with('success', 'تم تحديث نوع الحالة.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseType $caseType): RedirectResponse
    {
        $this->caseTypeService->delete($caseType);

        return redirect()
            ->route('admin.case-types.index')
            ->with('success', 'تم حذف نوع الحالة.');
    }
}
