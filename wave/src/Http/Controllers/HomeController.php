<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HomeStay;
use App\Models\Theme;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function home()
    {
        $activeTheme = Theme::where('is_active', true)->with('activeContents')->first();
        
        if (!$activeTheme) {
            return view('tenant.theme.default.index');
        }

        $viewPath = "tenant.theme.{$activeTheme->slug}.index";
        $homestays = HomeStay::orderBy('created_at', 'desc')
            ->take(9)
            ->get();
        if (!view()->exists($viewPath)) {
            $viewPath = 'tenant.theme.default.index';
        }
        return view($viewPath, compact('activeTheme', 'homestays'));
    }

    public function index()
    {
        // Get active tenants for display (latest 6)
        $activeTenants = Tenant::with('domains')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('central.home', compact('activeTenants'));
    }
}
