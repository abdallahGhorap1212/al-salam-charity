<?php

namespace App\Services;

use App\Exports\CasesExport;
use App\Imports\CasesImport;
use App\Models\CaseFile;
use App\Models\CaseModel;
use App\Repositories\Eloquent\CaseRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CaseService
{
    public function __construct(private readonly CaseRepository $caseRepository)
    {
    }

    public function search(?string $search, int $perPage = 15): LengthAwarePaginator
    {
        return $this->caseRepository->search($search, $perPage);
    }

    public function create(array $data, Request $request): CaseModel
    {
        $data['is_active'] = $request->boolean('is_active');

        $case = $this->caseRepository->create($data);
        $this->handleUploads($request, $case);

        return $case;
    }

    public function update(CaseModel $case, array $data, Request $request): bool
    {
        $data['is_active'] = $request->boolean('is_active');
        $updated = $this->caseRepository->update($case, $data);
        $this->handleUploads($request, $case);

        return $updated;
    }

    public function delete(CaseModel $case): bool
    {
        return $this->caseRepository->delete($case);
    }

    public function exportExcel()
    {
        return Excel::download(new CasesExport(), 'cases.xlsx');
    }

    public function exportPdf()
    {
        $cases = $this->caseRepository->latestWithRelations();
        $pdf = Pdf::loadView('admin.cases.pdf', compact('cases'));

        return $pdf->download('cases.pdf');
    }

    public function printAllCards()
    {
        $cases = $this->caseRepository->allWithRelations();
        
        // Generate barcode images for all cases and add them to the array
        $casesData = [];
        foreach ($cases as $case) {
            $barcodeUrl = $this->createBarcodeImage($case);
            $casesData[] = [
                'case' => $case,
                'barcodeUrl' => $barcodeUrl
            ];
        }

        return $casesData;
    }

    public function import(Request $request): void
    {
        Excel::import(new CasesImport(), $request->file('file'));
    }

    public function createBarcodeImage(CaseModel $case): ?string
    {
        $barcodeUrl = null;
        $barcodePath = 'barcodes/case-' . $case->id . '.png';

        try {
            $png = \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG($case->barcode, 'C128', 2, 48);
            if (!empty($png)) {
                Storage::disk('public')->put($barcodePath, base64_decode($png));
                $barcodeUrl = asset('storage/' . $barcodePath);
            }
        } catch (\Throwable $e) {
            $barcodeUrl = null;
        }

        return $barcodeUrl;
    }

    private function handleUploads(Request $request, CaseModel $case): void
    {
        if (! $request->hasFile('files')) {
            return;
        }

        foreach ($request->file('files') as $file) {
            $path = $file->store('cases', 'public');
            CaseFile::create([
                'case_id' => $case->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }
    }
}
