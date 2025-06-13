<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Theme;
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
        
        if (!view()->exists($viewPath)) {
            $viewPath = 'tenant.theme.default.index';
        }
        return view($viewPath, compact('activeTheme'));
    }
    public function index()
    {
        return view('central.home');
    }
}
