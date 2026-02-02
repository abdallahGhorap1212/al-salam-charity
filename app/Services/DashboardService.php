<?php

namespace App\Services;

use App\Models\AidDistribution;
use App\Models\Area;
use App\Models\CaseModel;
use App\Models\CaseType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    public function stats(): array
    {
        $today = Carbon::now()->startOfDay();
        $yesterday = $today->copy()->subDay();
        $last7Days = $today->copy()->subDays(7);
        $last30Days = $today->copy()->subDays(30);
        
        $totalCases = CaseModel::count();
        $activeCases = CaseModel::where('is_active', true)->count();
        $todayCases = CaseModel::whereDate('created_at', $today)->count();
        $yesterdayCases = CaseModel::whereDate('created_at', $yesterday)->count();
        $last7DaysCases = CaseModel::whereDate('created_at', '>=', $last7Days)->count();
        
        $totalDistributions = AidDistribution::count();
        $todayDistributions = AidDistribution::whereDate('distribution_date', $today)->count();
        $yesterdayDistributions = AidDistribution::whereDate('distribution_date', $yesterday)->count();
        
        return [
            // Core statistics
            'total_cases' => $totalCases,
            'active_cases' => $activeCases,
            'inactive_cases' => CaseModel::where('is_active', false)->count(),
            'total_areas' => Area::count(),
            'total_case_types' => CaseType::count(),
            'total_distributions' => $totalDistributions,
            'total_users' => User::count(),
            
            // Today's statistics
            'today_cases' => $todayCases,
            'today_distributions' => $todayDistributions,
            
            // Data trends
            'cases_trend' => $this->calculateTrend($todayCases, $yesterdayCases),
            'distributions_trend' => $this->calculateTrend($todayDistributions, $yesterdayDistributions),
            'weekly_cases_trend' => $this->calculateTrend($last7DaysCases, CaseModel::whereDate('created_at', '>=', $last7Days->copy()->subDays(7))->whereDate('created_at', '<', $last7Days)->count()),
            
            // Case distribution by area (for charts)
            'cases_by_area' => Area::withCount('cases')->get(),
            'cases_by_area_chart' => $this->formatChartData(
                Area::withCount('cases')->get(),
                'name',
                'cases_count'
            ),
            
            // Case distribution by type (for charts)
            'cases_by_type' => CaseType::withCount('cases')->get(),
            'cases_by_type_chart' => $this->formatChartData(
                CaseType::withCount('cases')->get(),
                'name',
                'cases_count'
            ),
            
            // Advanced statistics
            'advanced_stats' => $this->getAdvancedStatistics(),
            
            // System alerts
            'alerts' => $this->getSystemAlerts($today),
            
            // Staff performance
            'staff_performance' => $this->getStaffPerformance(),
            
            // Recent data
            'recent_cases' => CaseModel::with(['area', 'caseType'])
                ->latest()
                ->take(5)
                ->get(),
            'recent_distributions' => AidDistribution::with(['case', 'user'])
                ->latest()
                ->take(5)
                ->get(),
            
            // Today's activity
            'today_activity' => $this->getTodayActivity($today),
        ];
    }
    
    private function calculateTrend(int $current, int $previous): array
    {
        if ($previous == 0) {
            return [
                'value' => $current,
                'change' => $current > 0 ? 100 : 0,
                'direction' => $current > 0 ? 'up' : 'stable',
                'percentage' => $current > 0 ? '+100%' : '0%'
            ];
        }
        
        $change = (($current - $previous) / $previous) * 100;
        
        return [
            'value' => $current,
            'change' => $change,
            'direction' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'stable'),
            'percentage' => ($change > 0 ? '+' : '') . number_format($change, 1) . '%'
        ];
    }
    
    private function formatChartData(Collection $data, string $labelKey, string $valueKey): array
    {
        return [
            'labels' => $data->pluck($labelKey)->toArray(),
            'values' => $data->pluck($valueKey)->toArray(),
        ];
    }
    
    private function getAdvancedStatistics(): array
    {
        $allCases = CaseModel::with('aidDistributions')->get();
        $casesWithDistributions = $allCases->filter(fn($c) => $c->aidDistributions->count() > 0);
        
        $resolutionRate = $allCases->count() > 0 
            ? round(($casesWithDistributions->count() / $allCases->count()) * 100, 1)
            : 0;
        
        // Average days per case
        $avgDaysPerCase = 0;
        if ($casesWithDistributions->count() > 0) {
            $totalDays = $casesWithDistributions->sum(function($case) {
                $created = $case->created_at;
                $distributed = $case->aidDistributions->max('distribution_date');
                return $created->diffInDays($distributed ?? now());
            });
            $avgDaysPerCase = round($totalDays / $casesWithDistributions->count(), 1);
        }
        
        // Case distribution by type
        $caseTypeDistribution = CaseType::withCount('cases')
            ->get()
            ->map(fn($type) => [
                'name' => $type->name,
                'count' => $type->cases_count,
                'percentage' => $allCases->count() > 0 ? round(($type->cases_count / $allCases->count()) * 100, 1) : 0
            ])
            ->sortByDesc('count')
            ->take(5);
        
        return [
            'resolution_rate' => $resolutionRate,
            'avg_days_per_case' => $avgDaysPerCase,
            'case_type_distribution' => $caseTypeDistribution->values(),
            'resolved_cases' => $casesWithDistributions->count(),
            'pending_cases' => $allCases->count() - $casesWithDistributions->count(),
        ];
    }
    
    private function getSystemAlerts(Carbon $today): array
    {
        $alerts = [];
        
        // Outdated case alerts (over 60 days)
        $outdatedCases = CaseModel::where('created_at', '<', $today->copy()->subDays(60))
            ->where('is_active', true)
            ->count();
        if ($outdatedCases > 0) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => 'exclamation-triangle',
                'title' => 'حالات متقادمة',
                'message' => "هناك $outdatedCases حالة لم تُحل منذ أكثر من 60 يوم",
                'count' => $outdatedCases,
            ];
        }
        
        // Undistributed case alerts
        $neverDistributed = CaseModel::where('is_active', true)
            ->whereDoesntHave('aidDistributions')
            ->count();
        if ($neverDistributed > 0) {
            $alerts[] = [
                'type' => 'info',
                'icon' => 'info-circle',
                'title' => 'حالات بدون صرف',
                'message' => "هناك $neverDistributed حالة نشطة لم يتم صرف مساعدات لها بعد",
                'count' => $neverDistributed,
            ];
        }
        
        // Inactive staff alerts
        $inactiveUsers = User::where('is_active', false)->count();
        if ($inactiveUsers > 0) {
            $alerts[] = [
                'type' => 'secondary',
                'icon' => 'people',
                'title' => 'موظفون غير نشطين',
                'message' => "هناك $inactiveUsers موظف غير نشط في النظام",
                'count' => $inactiveUsers,
            ];
        }
        
        // Inactive case alerts
        $inactiveCases = CaseModel::where('is_active', false)->count();
        if ($inactiveCases > 0 && $inactiveCases > CaseModel::count() / 4) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => 'pause-circle',
                'title' => 'عدد كبير من الحالات المعطلة',
                'message' => "هناك $inactiveCases حالة معطلة (أكثر من 25% من إجمالي الحالات)",
                'count' => $inactiveCases,
            ];
        }
        
        return $alerts;
    }
    
    private function getStaffPerformance(): array
    {
        $users = User::with(['roles', 'cases'])
            ->get()
            ->map(function($user) {
                // Assigned cases count
                $assignedCases = CaseModel::where('user_id', $user->id)->count();
                
                // Resolved cases count
                $resolvedCases = CaseModel::where('user_id', $user->id)
                    ->whereHas('aidDistributions')
                    ->count();
                
                $resolutionRate = $assignedCases > 0 
                    ? round(($resolvedCases / $assignedCases) * 100, 1)
                    : 0;
                
                // Distributions count
                $distributions = AidDistribution::where('user_id', $user->id)->count();
                
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'assigned_cases' => $assignedCases,
                    'resolved_cases' => $resolvedCases,
                    'resolution_rate' => $resolutionRate,
                    'distributions' => $distributions,
                    'role' => $user->roles->first()?->name ?? 'بدون دور',
                ];
            })
            ->sortByDesc('assigned_cases')
            ->values()
            ->take(10);
        
        return $users->toArray();
    }
    
    private function getTodayActivity(Carbon $today): array
    {
        return [
            'new_cases' => CaseModel::whereDate('created_at', $today)
                ->with(['area', 'caseType'])
                ->latest()
                ->take(3)
                ->get(),
            'new_distributions' => AidDistribution::whereDate('distribution_date', $today)
                ->with(['case', 'user'])
                ->latest()
                ->take(3)
                ->get(),
        ];
    }
}
