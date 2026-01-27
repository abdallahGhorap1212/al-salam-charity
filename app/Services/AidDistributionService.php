<?php

namespace App\Services;

use App\Models\AidDistribution;
use App\Models\CaseModel;
use App\Repositories\Eloquent\AidDistributionRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DistributionsExport;

class AidDistributionService
{
    public function __construct(private readonly AidDistributionRepository $aidDistributionRepository)
    {
    }

    public function latestPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->aidDistributionRepository->latestPaginated($perPage);
    }

    public function filterByDates(?string $from, ?string $to, int $perPage = 15): LengthAwarePaginator
    {
        return $this->aidDistributionRepository->filterByDates($from, $to, $perPage);
    }

    public function createForBarcode(string $barcode, ?string $notes, bool $confirmOverride, ?int $distributionTypeId = null, ?float $amount = null): array
    {
        $case = CaseModel::where('barcode', $barcode)->first();
        if (! $case) {
            return ['error' => 'الباركود غير صحيح أو غير مسجل.'];
        }

        $latest = AidDistribution::where('case_id', $case->id)->latest()->first();
        if ($latest) {
            if ($latest->distribution_date?->isToday()) {
                return ['error' => 'تم صرف هذه الحالة اليوم بالفعل. لا يمكن تكرار الصرف في نفس اليوم.'];
            }

            if (! $confirmOverride) {
                return [
                    'confirm' => true,
                    'case_name' => $case->name,
                    'date' => $latest->distribution_date?->format('Y-m-d H:i'),
                ];
            }
        }

        AidDistribution::create([
            'case_id' => $case->id,
            'user_id' => Auth::id(),
            'distribution_type_id' => $distributionTypeId,
            'distribution_date' => now(),
            'amount' => $amount,
            'currency' => 'EGP',
            'notes' => $notes,
        ]);

        return ['success' => true];
    }

    public function exportExcel()
    {
        return Excel::download(new DistributionsExport(), 'distributions.xlsx');
    }

    public function exportPdf()
    {
        $distributions = AidDistribution::with(['case', 'user'])->latest()->get();
        $pdf = Pdf::loadView('admin.distributions.pdf', compact('distributions'));

        return $pdf->download('distributions.pdf');
    }
}
