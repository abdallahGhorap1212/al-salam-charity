<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
            $this->middleware('permission:view-reports')->only(['index', 'getCases']);
    }

    public function getCases(Request $request)
    {
        $query = CaseModel::with(['area', 'caseType', 'user', 'aidDistributions']);

        // Date range filter
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Area filter
        if ($request->filled('area_id')) {
            $query->where('area_id', $request->area_id);
        }

        // Case type filter
        if ($request->filled('case_type_id')) {
            $query->where('case_type_id', $request->case_type_id);
        }

        // User filter
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Status filter
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'active':
                    $query->where('is_active', true);
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
                case 'resolved':
                    $query->has('aidDistributions');
                    break;
            }
        }

        $cases = $query->latest()->get()->makeHidden(['barcode']);

        // Calculate statistics
        $total = $cases->count();
        $active = $cases->where('is_active', true)->count();
        $resolved = $cases->filter(fn($c) => $c->aidDistributions->count() > 0)->count();
        $distributions = $cases->sum(fn($c) => $c->aidDistributions->count());

        return response()->json([
            'cases' => $cases,
            'total' => $total,
            'active' => $active,
            'resolved' => $resolved,
            'distributions' => $distributions,
        ]);
    }
}
