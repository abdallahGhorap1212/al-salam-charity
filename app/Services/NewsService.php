<?php

namespace App\Services;

use App\Models\News;
use App\Models\NewsImage;
use App\Repositories\Eloquent\NewsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function __construct(private readonly NewsRepository $newsRepository)
    {
    }

    public function latestPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->newsRepository->latestPaginated($perPage);
    }

    public function published(int $limit = 10): Collection
    {
        return $this->newsRepository->published($limit);
    }

    public function publishedPaginated(int $perPage = 8): LengthAwarePaginator
    {
        return $this->newsRepository->publishedPaginated($perPage);
    }

    public function loadForShow(News $news): News
    {
        return $this->newsRepository->withImages($news);
    }

    public function create(array $data, Request $request): News
    {
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = empty($data['published_at']) ? null : $data['published_at'];
        $data['cover_image'] = null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $news = $this->newsRepository->create($data);
        $this->storeGallery($news, $request);

        return $news;
    }

    public function update(News $news, array $data, Request $request): bool
    {
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = empty($data['published_at']) ? null : $data['published_at'];
        $data['cover_image'] = $news->cover_image;

        if ($request->boolean('remove_cover_image')) {
            $this->deleteCover($news->cover_image);
            $data['cover_image'] = null;
        }

        if ($request->hasFile('cover_image')) {
            $this->deleteCover($news->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $this->removeGalleryImages($news, $request->input('remove_gallery', []));
        $this->storeGallery($news, $request);

        return $this->newsRepository->update($news, $data);
    }

    public function delete(News $news): bool
    {
        $this->deleteCover($news->cover_image);
        foreach ($news->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        return $this->newsRepository->delete($news);
    }

    private function storeGallery(News $news, Request $request): void
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        foreach ($request->file('gallery') as $index => $file) {
            $path = $file->store('news/gallery', 'public');
            NewsImage::create([
                'news_id' => $news->id,
                'path' => $path,
                'sort_order' => $index,
            ]);
        }
    }

    private function removeGalleryImages(News $news, array $ids): void
    {
        if (empty($ids)) {
            return;
        }

        $images = $news->images()->whereIn('id', $ids)->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }

    private function deleteCover(?string $cover): void
    {
        if (! $cover) {
            return;
        }

        Storage::disk('public')->delete($cover);
    }
}
