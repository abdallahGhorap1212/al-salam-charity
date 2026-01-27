<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\ContactStoreRequest;
use App\Http\Requests\Site\DonationStoreRequest;
use App\Models\News;
use App\Models\Service;
use App\Models\TermsAndConditions;
use App\Services\AboutService;
use App\Services\BoardMemberService;
use App\Services\ContactMessageService;
use App\Services\DonationRequestService;
use App\Services\NewsService;
use App\Services\ServiceService;
use App\Support\HtmlSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function __construct(
        private readonly AboutService $aboutService,
        private readonly ServiceService $serviceService,
        private readonly NewsService $newsService,
        private readonly BoardMemberService $boardMemberService,
        private readonly ContactMessageService $contactMessageService,
        private readonly DonationRequestService $donationRequestService
    ) {
    }

    public function home(): View
    {
        $about = $this->aboutService->getOrCreate();
        $services = $this->serviceService->active(6);
        $news = $this->newsService->published(10);
        $boardMembers = $this->boardMemberService->active(6);

        return view('site.home', compact('about', 'services', 'news', 'boardMembers'));
    }

    public function about(): View
    {
        $about = $this->aboutService->getOrCreate();
        $boardMembers = $this->boardMemberService->active();

        return view('site.about', compact('about', 'boardMembers'));
    }

    public function termsAndConditions(): View
    {
        $termsAndConditions = TermsAndConditions::firstOrCreate([
            'id' => 1,
        ], [
            'title' => 'الشروط والأحكام',
            'content' => 'يرجى إضافة محتوى الشروط والأحكام هنا',
            'is_active' => true,
        ]);

        return view('site.terms-and-conditions', compact('termsAndConditions'));
    }

    public function services(): View
    {
        $services = $this->serviceService->activePaginated(8);

        return view('site.services', compact('services'));
    }

    public function serviceShow(Service $service): View
    {
        if (! $service->is_active) {
            abort(404);
        }

        return view('site.service-show', compact('service'));
    }

    public function news(): View
    {
        $news = $this->newsService->publishedPaginated(8);

        return view('site.news', compact('news'));
    }

    public function newsShow(News $news): View
    {
        if (! $news->is_published || ($news->published_at && $news->published_at->isFuture())) {
            abort(404);
        }

        $news = $this->newsService->loadForShow($news);
        $bodyHtml = HtmlSanitizer::clean($news->body);

        return view('site.news-show', compact('news', 'bodyHtml'));
    }

    public function contact(): View
    {
        $about = $this->aboutService->getOrCreate();

        return view('site.contact', compact('about'));
    }

    public function contactStore(ContactStoreRequest $request): RedirectResponse
    {
        $this->contactMessageService->create($request->validated());

        return redirect()
            ->route('site.contact')
            ->with('success', 'تم استلام رسالتك بنجاح، وسنتواصل معك قريبًا.');
    }

    public function donations(): View
    {
        $about = $this->aboutService->getOrCreate();
        $services = $this->serviceService->active();

        return view('site.donations', compact('about', 'services'));
    }

    public function donationsStore(DonationStoreRequest $request): RedirectResponse
    {
        $this->donationRequestService->create($request->validated());

        return redirect()
            ->route('site.donations')
            ->with('success', 'تم تسجيل طلب التبرع، سنقوم بالتواصل معك لإكمال الإجراءات.');
    }
}
