<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AboutService;
use App\Http\Requests\Admin\AboutUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __construct(private readonly AboutService $aboutService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-about')->only(['edit']);
        $this->middleware('permission:edit-about')->only(['update']);
    }

    public function edit(): View
    {
        $about = $this->aboutService->getOrCreate();
        // Fetch social links from settings
        $social = \App\Support\SettingsHelper::getSocialLinks();
        return view('admin.about.edit', compact('about', 'social'));
    }

    public function update(AboutUpdateRequest $request): RedirectResponse
    {
        $this->aboutService->update($request->validated());

        return redirect()
            ->route('admin.about.edit')
            ->with('success', 'تم تحديث بيانات الجمعية.');
    }
}
