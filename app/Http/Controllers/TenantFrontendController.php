<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantFrontendController extends Controller
{
    public function index(){
        $tenants = Tenant::with('domains')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::where('is_active', true)->count(),
            'pending_tenants' => Tenant::where('is_active', false)->count(),    
            'provinces_count' => Tenant::distinct('provinsi')->count(),
        ];

        return view('central.tenants.index', compact('tenants', 'stats'));
    }
}
