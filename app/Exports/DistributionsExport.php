<?php

namespace App\Exports;

use App\Models\AidDistribution;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DistributionsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Case',
            'User',
            'Date',
            'Notes',
        ];
    }

    public function collection()
    {
        return AidDistribution::with(['case', 'user'])
            ->latest()
            ->get()
            ->map(function (AidDistribution $distribution) {
                return [
                    $distribution->case?->name,
                    $distribution->user?->name,
                    optional($distribution->distribution_date)->format('Y-m-d H:i'),
                    $distribution->notes,
                ];
            });
    }
}
