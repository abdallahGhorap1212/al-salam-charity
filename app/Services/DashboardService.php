<?php

namespace App\Services;

use App\Models\AidDistribution;
use App\Models\Area;
use App\Models\CaseModel;
use App\Models\CaseType;
use App\Models\User;

class DashboardService
{
    public function stats(): array
    {
        return [
            'total_cases' => CaseModel::count(),
            'active_cases' => CaseModel::where('is_active', true)->count(),
            'total_areas' => Area::count(),
            'total_case_types' => CaseType::count(),
            'total_distributions' => AidDistribution::count(),
            'total_users' => User::count(),
            'recent_cases' => CaseModel::with(['area', 'caseType'])
                ->latest()
                ->take(5)
                ->get(),
            'recent_distributions' => AidDistribution::with(['case', 'user'])
                ->latest()
                ->take(5)
                ->get(),
        ];
    }
}
