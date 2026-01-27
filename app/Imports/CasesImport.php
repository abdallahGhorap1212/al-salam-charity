<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\CaseModel;
use App\Models\CaseType;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CasesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $name = trim((string) ($row['name'] ?? $row['الاسم'] ?? ''));
            if ($name === '') {
                continue;
            }

            $areaValue = trim((string) ($row['area'] ?? $row['المنطقة'] ?? ''));
            $typeValue = trim((string) ($row['case_type'] ?? $row['نوع_الحالة'] ?? ''));

            $area = $areaValue !== '' ? Area::where('code', $areaValue)->orWhere('name', $areaValue)->first() : null;
            $caseType = $typeValue !== '' ? CaseType::where('code', $typeValue)->orWhere('name', $typeValue)->first() : null;

            if (!$area || !$caseType) {
                continue;
            }

            CaseModel::create([
                'case_number' => $row['case_number'] ?? $row['رقم_الحالة'] ?? null,
                'name' => $name,
                'national_id' => $row['national_id'] ?? $row['الرقم_القومي'] ?? null,
                'phone' => $row['phone'] ?? $row['الهاتف'] ?? null,
                'family_members_count' => $row['family_members_count'] ?? $row['عدد_افراد_الاسرة'] ?? null,
                'address' => $row['address'] ?? $row['العنوان'] ?? null,
                'area_id' => $area->id,
                'case_type_id' => $caseType->id,
                'notes' => $row['notes'] ?? $row['ملاحظات'] ?? null,
                'is_active' => (bool) ($row['is_active'] ?? $row['نشط'] ?? true),
            ]);
        }
    }
}
