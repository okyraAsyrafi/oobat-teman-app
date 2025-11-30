<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\DashboardService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        // Dependency Injection DashboardService
        $this->dashboardService = $dashboardService;
        // Middleware: pastikan hanya petugas yang bisa mengakses
        $this->middleware('auth');
    }

    /**
     * Menampilkan dashboard petugas dengan data ringkasan dan tren.
     */
    public function index(): View
    {
        // Ambil data summary cards
        $summaryData = $this->dashboardService->getSummaryData();

        // Ambil data chart tren 30 hari
        $chartData = $this->dashboardService->getCompliancePatientTrend(30);

        // Contoh data Notifikasi/Quick Tasks
        // Kita mengambil nilai 'not_taken_today' dari $summaryData agar dinamis
        $quickTasks = [
            // 💡 PERBAIKAN: Ambil data dinamis Belum Konfirmasi dari summaryData
            'not_taken_today' => $summaryData['not_taken_today'],

            'questionnaire_due' => 2, // Contoh placeholder
            'schedules_ending' => 5,  // Contoh placeholder
            'new_side_effects' => 1,  // Contoh placeholder
        ];

        return view('dashboard', [
            // Summary Cards
            'summary' => $summaryData,

            // Chart Data (30 Hari)
            'complianceChart' => $chartData,

            // Quick Tasks
            'quickTasks' => $quickTasks
        ]);
    }
}
