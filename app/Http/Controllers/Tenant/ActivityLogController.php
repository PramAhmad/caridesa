<?php
// filepath: /home/pram/project/astacode/sass-garut/app/Http/Controllers/Tenant/ActivityLogController.php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    /**
     * Display the activity logs
     */
    public function index(Request $request)
    {

        $this->authorize('view-logs');
        $tables = collect($this->getTrackedTables())->sort()->values();
        $query = Activity::with('causer');
        
        if ($request->filled('table')) {
            $query->where('log_name', $request->table);
        }
        
        if ($request->filled('event')) {
            $query->where('description', $request->event);
        }
        
        if ($request->filled('user')) {
            $query->whereHasMorph('causer', 'App\Models\User', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%')
                  ->orWhere('email', 'like', '%' . $request->user . '%');
            });
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $logs = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('tenant.logs.index', compact('logs', 'tables'));
    }
    
    /**
     * Display the details of a specific log entry
     */
    public function show($id)
    {
        $this->authorize('view-logs');
        
        $log = Activity::with('causer')->findOrFail($id);
        
        return view('tenant.logs.show', compact('log'));
    }
    
    /**
     * Clear all activity logs
     */
    public function clear()
    {
        $this->authorize('manage-logs');
        Activity::truncate();
        return redirect()->route('tenant.logs.index')
                ->with('success', 'All activity logs have been cleared successfully.');
    }
    
    /**
     * Export activity logs to CSV
     */
    public function export(Request $request)
    {
        $this->authorize('export-logs');
        $query = Activity::with('causer');
        if ($request->filled('table')) {
            $query->where('log_name', $request->table);
        }
        if ($request->filled('event')) {
            $query->where('description', $request->event);
        }
        if ($request->filled('user')) {
            $query->whereHasMorph('causer', 'App\Models\User', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%')
                  ->orWhere('email', 'like', '%' . $request->user . '%');
            });
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $logs = $query->orderBy('created_at', 'desc')->get();
        
        // Generate CSV
        $filename = 'activity_logs_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        
        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // ini header csv
            fputcsv($file, [
                'ID',
                'Date & Time',
                'Table',
                'Event',
                'User',
                'IP Address',
                'Before Changes',
                'After Changes'
            ]);
            
            // Add log data
            foreach($logs as $log) {
                $oldValues = $log->properties->has('old') ? json_encode($log->properties['old']) : '';
                $newValues = $log->properties->has('attributes') ? json_encode($log->properties['attributes']) : '';
                
                fputcsv($file, [
                    $log->id,
                    $log->created_at,
                    $log->log_name,
                    $log->description,
                    $log->causer ? $log->causer->name : 'System',
                    $log->properties['ip'] ?? 'N/A',
                    $oldValues,
                    $newValues
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Get a list of tables that are being tracked
     */
    private function getTrackedTables()
    {
        /**
         * Ini mengambil daftar tabel yang sedang dilacak
         * dengan menggunakan log_name dari model Activity.
         * Karena log_name menyimpan nama tabel
         * yang sedang dilacak, kita bisa mengambilnya
         * secara unik menggunakan distinct.
         */
        $tables = Activity::distinct('log_name')->pluck('log_name')->toArray();
        return $tables;
    }
}