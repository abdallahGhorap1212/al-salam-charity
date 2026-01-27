<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Services\AreaService;
use App\Http\Requests\Admin\AreaStoreRequest;
use App\Http\Requests\Admin\AreaUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AreaController extends Controller
{
    public function __construct(private readonly AreaService $areaService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-areas')->only(['index']);
        $this->middleware('permission:create-areas')->only(['create', 'store']);
        $this->middleware('permission:edit-areas')->only(['edit', 'update']);
        $this->middleware('permission:delete-areas')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $areas = $this->areaService->orderedPaginated(15);

        return view('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AreaStoreRequest $request): RedirectResponse
    {
        $this->areaService->create($request->validated(), $request->boolean('is_active'));

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'تم إضافة المنطقة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area): View
    {
        return view('admin.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area): View
    {
        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaUpdateRequest $request, Area $area): RedirectResponse
    {
        $this->areaService->update($area, $request->validated(), $request->boolean('is_active'));

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'تم تحديث بيانات المنطقة.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area): RedirectResponse
    {
        $this->areaService->delete($area);

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'تم حذف المنطقة.');
    }
}
