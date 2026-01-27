<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AidDistributionStoreRequest;
use App\Services\AidDistributionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AidDistributionController extends Controller
{
    public function __construct(private readonly AidDistributionService $aidDistributionService)
    {
        $this->middleware('auth');
        $this->middleware('permission:view-distributions')->only(['index']);
        $this->middleware('permission:create-distributions')->only(['create', 'store']);
        $this->middleware('permission:scan-barcode')->only(['create', 'store']);
    }

    public function index(Request $request): View
    {
        $from = $request->date('from')?->format('Y-m-d');
        $to = $request->date('to')?->format('Y-m-d');
        $distributions = $this->aidDistributionService->filterByDates($from, $to, 15);

        return view('admin.distributions.index', compact('distributions'));
    }

    public function create(): View
    {
        return view('admin.distributions.create');
    }

    public function store(AidDistributionStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $result = $this->aidDistributionService->createForBarcode(
            $data['barcode'],
            $data['notes'] ?? null,
            $request->boolean('confirm_override')
        );

        if (!empty($result['error'])) {
            return redirect()
                ->back()
                ->withErrors(['barcode' => $result['error']])
                ->withInput();
        }

        if (!empty($result['confirm'])) {
            return redirect()
                ->back()
                ->withInput()
                ->with('previous_distribution', [
                    'case_name' => $result['case_name'] ?? '',
                    'date' => $result['date'] ?? '',
                ]);
        }

        return redirect()
            ->route('admin.distributions.index')
            ->with('success', 'تم تسجيل الاستلام بنجاح.');
    }

    public function exportExcel()
    {
        return $this->aidDistributionService->exportExcel();
    }

    public function exportPdf()
    {
        return $this->aidDistributionService->exportPdf();
    }
}
