<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getVisitorStats(Request $request)
{
    $days = $request->input('days', 30);
    $endDate = now();
    $startDate = now()->subDays($days);
    
    $stats = [
        'today_visits' => \App\Models\Visit::whereDate('created_at', today())->count(),
        'total_visits' => \App\Models\Visit::whereBetween('created_at', [$startDate, $endDate])->count(),
        'unique_visitors' => \App\Models\Visit::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('ip_address')
            ->count('ip_address'),
        'popular_pages' => \App\Models\Visit::select('page_visited')
            ->selectRaw('count(*) as visit_count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('page_visited')
            ->orderBy('visit_count', 'desc')
            ->limit(5)
            ->get(),
        'chart' => $this->getVisitorChartData($days)
    ];
    
    return response()->json($stats);
}

private function getVisitorChartData($days = 30)
{
    $endDate = now();
    $startDate = now()->subDays($days);
    
    $visits = \App\Models\Visit::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $labels = [];
    $data = [];
    
    // Initialize array with 0 for all days in the range
    for ($i = 0; $i <= $days; $i++) {
        $date = $startDate->copy()->addDays($i)->format('Y-m-d');
        $labels[] = $startDate->copy()->addDays($i)->format('M d');
        $data[$date] = 0;
    }
    
    // Update data with actual values
    foreach ($visits as $visit) {
        $date = \Carbon\Carbon::parse($visit->date)->format('Y-m-d');
        if (isset($data[$date])) {
            $data[$date] = $visit->count;
        }
    }
    
    return [
        'labels' => $labels,
        'data' => array_values($data)
    ];
}
}
