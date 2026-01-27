<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\NewsService;
use App\Http\Requests\Admin\NewsStoreRequest;
use App\Http\Requests\Admin\NewsUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function __construct(private readonly NewsService $newsService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-news')->only(['index', 'show']);
        $this->middleware('permission:create-news')->only(['create', 'store']);
        $this->middleware('permission:edit-news')->only(['edit', 'update']);
        $this->middleware('permission:delete-news')->only(['destroy']);
    }

    public function index(): View
    {
        $news = $this->newsService->latestPaginated(15);

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(NewsStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->generateSlug($data['slug'] ?? $data['title']);

        $this->newsService->create($data, $request);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'تم إضافة الخبر بنجاح.');
    }

    public function show(News $news): View
    {
        $this->newsService->loadForShow($news);
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsUpdateRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->generateSlug($data['slug'] ?? $data['title'], $news->id);

        $this->newsService->update($news, $data, $request);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'تم تحديث الخبر بنجاح.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $this->newsService->delete($news);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'تم حذف الخبر.');
    }

    private function generateSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = \Illuminate\Support\Str::slug($value);
        if ($baseSlug === '') {
            $baseSlug = 'news';
        }
        $slug = $baseSlug;
        $counter = 1;

        while (
            News::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
