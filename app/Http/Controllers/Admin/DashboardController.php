<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Lead;
use App\Models\Package;
use App\Models\Promo;
use App\Models\SalesProfile;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = SalesProfile::get();

        return view('admin.dashboard', [
            'totalLeads' => Lead::count(),
            'newLeads' => Lead::where('status', 'baru')->count(),
            'activePackages' => Package::where('status', true)->count(),
            'activePromos' => Promo::where('status', true)->count(),
            'totalBanners' => Banner::count(),
            'waClicks' => 0,
            'recentLeads' => Lead::latest()->take(5)->get(),
            'leadsThisMonth' => Lead::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'leadsByStatus' => Lead::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')->toArray(),
            'waNumber' => $sales->waNumber(),
        ]);
    }
}
