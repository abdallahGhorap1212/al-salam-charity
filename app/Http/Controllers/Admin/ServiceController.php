<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceStoreRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(private readonly ServiceService $serviceService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-services')->only(['index', 'show']);
        $this->middleware('permission:create-services')->only(['create', 'store']);
        $this->middleware('permission:edit-services')->only(['edit', 'update']);
        $this->middleware('permission:delete-services')->only(['destroy']);
    }

    public function index(): View
    {
        $services = $this->serviceService->orderedPaginated(15);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(ServiceStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->generateSlug($data['slug'] ?? $data['title']);
        $this->serviceService->create($data, $request);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'تم إضافة الخدمة بنجاح.');
    }

    public function show(Service $service): View
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceUpdateRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->generateSlug($data['slug'] ?? $data['title'], $service->id);
        $this->serviceService->update($service, $data, $request);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->serviceService->delete($service);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'تم حذف الخدمة.');
    }

    private function generateSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = \Illuminate\Support\Str::slug($value);
        if ($baseSlug === '') {
            $baseSlug = 'service';
        }
        $slug = $baseSlug;
        $counter = 1;

        while (
            Service::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
