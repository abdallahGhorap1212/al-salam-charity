<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DistributionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DistributionTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:manage-distribution-types')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(): View
    {
        $types = DistributionType::orderBy('order')->paginate(15);
        return view('admin.distribution-types.index', compact('types'));
    }

    public function create(): View
    {
        $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'muted'];
        $icons = ['bi-cash-coin', 'bi-basket', 'bi-capsule', 'bi-bandage', 'bi-bag', 'bi-book', 'bi-box-seam', 'bi-droplet', 'bi-lamp'];
        return view('admin.distribution-types.create', compact('colors', 'icons'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:distribution_types'],
            'ar_name' => ['required', 'string', 'unique:distribution_types'],
            'description' => ['nullable', 'string'],
            'icon' => ['required', 'string'],
            'color' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        DistributionType::create($validated);

        return redirect()
            ->route('admin.distribution-types.index')
            ->with('success', 'تم إنشاء نوع المصروف بنجاح.');
    }

    public function edit(DistributionType $distributionType): View
    {
        $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'muted'];
        $icons = ['bi-cash-coin', 'bi-basket', 'bi-capsule', 'bi-bandage', 'bi-bag', 'bi-book', 'bi-box-seam', 'bi-droplet', 'bi-lamp'];
        return view('admin.distribution-types.edit', compact('distributionType', 'colors', 'icons'));
    }

    public function update(Request $request, DistributionType $distributionType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:distribution_types,name,' . $distributionType->id],
            'ar_name' => ['required', 'string', 'unique:distribution_types,ar_name,' . $distributionType->id],
            'description' => ['nullable', 'string'],
            'icon' => ['required', 'string'],
            'color' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $distributionType->update($validated);

        return redirect()
            ->route('admin.distribution-types.index')
            ->with('success', 'تم تحديث نوع المصروف بنجاح.');
    }

    public function destroy(DistributionType $distributionType): RedirectResponse
    {
        $distributionType->delete();

        return redirect()
            ->route('admin.distribution-types.index')
            ->with('success', 'تم حذف نوع المصروف بنجاح.');
    }
}
