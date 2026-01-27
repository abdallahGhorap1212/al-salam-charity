<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(private readonly DashboardService $dashboardService)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stats = $this->dashboardService->stats();

        return view('admin.dashboard', compact('stats'));
    }
}
