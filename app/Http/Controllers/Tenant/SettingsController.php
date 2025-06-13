<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function general()
    {
        $settings = Setting::whereIn('key', [
            'app_name', 
            'app_description', 
            'app_logo', 
            'app_favicon',
            'primary_color',
            'footer_text',
            'timezone',
            'date_format',
            'nomor_badan_hukum',
            'mata_uang'
        ])->get()->keyBy('key');
        
        return view('tenant.settings.general', compact('settings'));
    }
    
    public function updateGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:1000',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'app_favicon' => 'nullable|image|mimes:jpeg,png,jpg,ico|max:1024',
            'primary_color' => 'nullable|string|max:20',
            'footer_text' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:100',
            'date_format' => 'nullable|string|max:50',
            'nomor_badan_hukum' => 'nullable|string|max:100',
            'mata_uang' => 'nullable|string|max:10',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        /*
         * Handle file uploads untuk logo dan favicon
         * Store di disk public untuk mudah diakses
         */
        if ($request->hasFile('app_logo')) {
            $logo = $request->file('app_logo');
            $logoPath = $logo->store('settings', 'public');
            $this->updateSetting('app_logo', $logoPath);
        }
        
        if ($request->hasFile('app_favicon')) {
            $favicon = $request->file('app_favicon');
            $faviconPath = $favicon->store('settings', 'public');
            $this->updateSetting('app_favicon', $faviconPath);
        }
        
        // Update all text settings
        $this->updateSetting('app_name', $request->app_name);
        $this->updateSetting('app_description', $request->app_description);
        $this->updateSetting('primary_color', $request->primary_color);
        $this->updateSetting('footer_text', $request->footer_text);
        $this->updateSetting('timezone', $request->timezone);
        $this->updateSetting('date_format', $request->date_format);
        $this->updateSetting('nomor_badan_hukum', $request->nomor_badan_hukum);
        $this->updateSetting('mata_uang', $request->mata_uang);
        
        return redirect()->back()->with('success', 'General settings updated successfully!');
    }
    
    public function security()
    {
        $settings = Setting::whereIn('key', [
            'password_expiry_days',
            'min_password_length',
            'require_special_chars',
            'session_timeout_minutes',
            'login_attempts_before_lockout',
            'lockout_minutes',
            'two_factor_enabled',
            'allowed_ip_addresses'
        ])->get()->keyBy('key');
        
        return view('tenant.settings.security', compact('settings'));
    }
    
    public function updateSecurity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_expiry_days' => 'nullable|integer|min:0|max:365',
            'min_password_length' => 'nullable|integer|min:6|max:20',
            'require_special_chars' => 'nullable|boolean',
            'session_timeout_minutes' => 'nullable|integer|min:1|max:1440',
            'login_attempts_before_lockout' => 'nullable|integer|min:1|max:10',
            'lockout_minutes' => 'nullable|integer|min:1|max:1440',
            'two_factor_enabled' => 'nullable|boolean',
            'allowed_ip_addresses' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        /*
         * Update security settings
         * Boolean values dikonversi ke integer untuk database
         */
        $this->updateSetting('password_expiry_days', $request->password_expiry_days);
        $this->updateSetting('min_password_length', $request->min_password_length);
        $this->updateSetting('require_special_chars', $request->require_special_chars ? 1 : 0);
        $this->updateSetting('session_timeout_minutes', $request->session_timeout_minutes);
        $this->updateSetting('login_attempts_before_lockout', $request->login_attempts_before_lockout);
        $this->updateSetting('lockout_minutes', $request->lockout_minutes);
        $this->updateSetting('two_factor_enabled', $request->two_factor_enabled ? 1 : 0);
        $this->updateSetting('allowed_ip_addresses', $request->allowed_ip_addresses);
        
        return redirect()->back()->with('success', 'Security settings updated successfully!');
    }
    
    private function updateSetting($key, $value)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}