<?php

namespace App\Exports;

use App\Models\CaseModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CasesExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Case Number',
            'Name',
            'National ID',
            'Phone',
            'Family Members',
            'Address',
            'Area',
            'Case Type',
            'Notes',
            'Active',
        ];
    }

    public function collection()
    {
        return CaseModel::with(['area', 'caseType'])
            ->latest()
            ->get()
            ->map(function (CaseModel $case) {
                return [
                    $case->case_number,
                    $case->name,
                    $case->national_id,
                    $case->phone,
                    $case->family_members_count,
                    $case->address,
                    $case->area?->name,
                    $case->caseType?->name,
                    $case->notes,
                    $case->is_active ? 'Yes' : 'No',
                ];
            });
    }
}
