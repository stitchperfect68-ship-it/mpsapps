<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\ProductionOrder;
use App\Models\Client;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index() { return view('analytics.index'); }
    public function revenue() { return view('analytics.index'); }
    public function productionMetrics() { return view('analytics.index'); }
    public function clientMetrics() { return view('analytics.index'); }
    public function staffPerformance() { return view('analytics.index'); }
    public function inventoryTrends() { return view('analytics.index'); }
    public function export(string $report) { return back(); }
    public function revenueChartData() { return response()->json([]); }
    public function ordersChartData() { return response()->json([]); }
    public function topClientsData() { return response()->json([]); }
}
