<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CaseImportRequest;
use App\Http\Requests\Admin\CaseStoreRequest;
use App\Http\Requests\Admin\CaseUpdateRequest;
use App\Models\CaseModel;
use App\Services\AreaService;
use App\Services\CaseService;
use App\Services\CaseTypeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseController extends Controller
{
    public function __construct(
        private readonly CaseService $caseService,
        private readonly AreaService $areaService,
        private readonly CaseTypeService $caseTypeService
    ) {
        $this->middleware('auth');
        $this->middleware('auth');
        $this->middleware('permission:view-cases')->only(['index', 'show']);
        $this->middleware('permission:create-cases')->only(['create', 'store']);
        $this->middleware('permission:edit-cases')->only(['edit', 'update']);
        $this->middleware('permission:delete-cases')->only(['destroy']);
        $this->middleware('permission:import-cases')->only(['import']);
        $this->middleware('permission:export-cases')->only(['exportExcel', 'exportPdf']);
        $this->middleware('permission:print-cases')->only(['card', 'printAllCards']);
    }

    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();
        $cases = $this->caseService->search($search, 15);

        return view('admin.cases.index', compact('cases'));
    }

    public function create(): View
    {
        $areas = $this->areaService->orderedAll();
        $caseTypes = $this->caseTypeService->orderedAll();

        return view('admin.cases.create', compact('areas', 'caseTypes'));
    }

    public function store(CaseStoreRequest $request): RedirectResponse
    {
        $this->caseService->create($request->validated(), $request);

        return redirect()
            ->route('admin.cases.index')
            ->with('success', 'تم إنشاء الحالة بنجاح.');
    }

    public function show(CaseModel $case): View
    {
        $case->load([
            'area',
            'caseType',
            'user',
            'aidDistributions' => function ($query) {
                $query->latest('distribution_date')->with('type', 'user');
            },
        ]);

        // Calculate statistics
        $totalDistributions = $case->aidDistributions->count();
        $lastDistribution = $case->aidDistributions->first();
        $firstDistribution = $case->aidDistributions->last();

        return view('admin.cases.show', compact(
            'case',
            'totalDistributions',
            'lastDistribution',
            'firstDistribution'
        ));
    }

    public function edit(CaseModel $case): View
    {
        $areas = $this->areaService->orderedAll();
        $caseTypes = $this->caseTypeService->orderedAll();
        $case->load('files');

        return view('admin.cases.edit', compact('case', 'areas', 'caseTypes'));
    }

    public function update(CaseUpdateRequest $request, CaseModel $case): RedirectResponse
    {
        $this->caseService->update($case, $request->validated(), $request);

        return redirect()
            ->route('admin.cases.index')
            ->with('success', 'تم تحديث بيانات الحالة.');
    }

    public function destroy(CaseModel $case): RedirectResponse
    {
        $this->caseService->delete($case);

        return redirect()
            ->route('admin.cases.index')
            ->with('success', 'تم حذف الحالة.');
    }

    public function exportExcel()
    {
        return $this->caseService->exportExcel();
    }

    public function exportPdf()
    {
        return $this->caseService->exportPdf();
    }

    public function import(CaseImportRequest $request): RedirectResponse
    {
        $this->caseService->import($request);

        return redirect()
            ->route('admin.cases.index')
            ->with('success', 'تم استيراد الحالات بنجاح.');
    }

    public function card(CaseModel $case): View
    {
        $case->load(['area', 'caseType']);
        $barcodeUrl = $this->caseService->createBarcodeImage($case);

        return view('admin.cases.card', compact('case', 'barcodeUrl'));
    }

    public function printAllCards()
    {
        $casesData = $this->caseService->printAllCards();
        return view('admin.cases.cards-bulk', compact('casesData'));
    }
}
