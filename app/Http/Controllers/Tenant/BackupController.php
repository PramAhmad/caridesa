<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    /**
     * Custom backup path within storage
     */
    protected $backupPath = 'storage/tenant';

    /**
     * Display the backup page
     */
    public function index()
    {
        $tenantId = tenant('id');
        $tenantBackupPath = $this->backupPath . $tenantId . '/app/SASS GARUT';

        if (!Storage::exists($tenantBackupPath)) {
            Storage::makeDirectory($tenantBackupPath);
        }
        
        $backups = collect(Storage::disk('local')->allFiles())
            ->filter(function ($file) {
                return Str::endsWith($file, '.zip');
            })
            ->map(function ($file) {
                return [
                    'name' => basename($file),
                ];
            })
            ->sortByDesc('last_modified');
            
        return view('tenant.settings.backups', compact('backups'));
    }
    
    /**
     * Create a new backup
     */
    public function create(Request $request)
    {
        $this->authorize('manage-backups');
        
        try {
            ini_set('max_execution_time', 600); 
            
            $tenantId = tenant('id');
            $destinationPath = $this->backupPath . $tenantId . '/SASS GARUT';
            
            if (!Storage::exists($destinationPath)) {
                Storage::makeDirectory($destinationPath);
            }
            
            // Set backup path
            config(['backup.backup.destination.disks' => ['local']]);
            config(['backup.backup.destination.path' => $destinationPath]);
            
            $exitCode = Artisan::call('backup:run', [
                '--only-db' => $request->has('only_db'),
                '--disable-notifications' => true,
            ]);
            
            if ($exitCode === 0) {
                return redirect()->back()->with('success', 'Backup created successfully!');
            }
            
            Log::error('Backup command failed with exit code: ' . $exitCode);
            return redirect()->back()->with('error', 'Backup failed. Please check the logs.');
            
        } catch (\Exception $e) {
            Log::error('Backup exception: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Download a backup file
     */
    public function download($filename)
    {
        $this->authorize('manage-backups');
        
        $filename = basename($filename);
        $tenantId = tenant('id');
        $fullPath = $this->backupPath . $tenantId . '/SASS GARUT/' . $filename;
        
        if (!Storage::exists($fullPath)) {
            return redirect()->back()->with('error', 'Backup file not found.');
        }
        
        return Storage::download($fullPath, $filename);
    }
    
    /**
     * Delete a backup file
     */
    public function destroy($filename)
    {
        $this->authorize('manage-backups');
        
        $filename = basename($filename);
        $tenantId = tenant('id');
        $fullPath = $this->backupPath . $tenantId . '/SASS GARUT/' . $filename;
        
        if (Storage::exists($fullPath)) {
            Storage::delete($fullPath);
            return redirect()->back()->with('success', 'Backup deleted successfully!');
        }
        
        return redirect()->back()->with('error', 'Backup file not found.');
    }
    
    /**
     * Restore from a backup file
     */
    public function restore($filename)
    {
        $this->authorize('manage-backups');
        
        if (!auth()->user()->hasRole('Super Admin')) {
            return redirect()->back()
                ->with('error', 'Only Super Admins can restore backups.');
        }
        
        $filename = basename($filename);
        $tenantId = tenant('id');
        $fullPath = $this->backupPath . $tenantId . '/SASS GARUT/' . $filename;
        
        if (!Storage::exists($fullPath)) {
            return redirect()->back()
                ->with('error', 'Backup file not found.');
        }
        
        try {
            // For safety, create a new backup before restoring
            $timestamp = date('Y_m_d_H_i_s');
            $preRestoreBackupPath = $this->backupPath . $tenantId . '/SASS GARUT';
            
            config(['backup.backup.destination.disks' => ['local']]);
            config(['backup.backup.destination.path' => $preRestoreBackupPath]);
            config(['backup.backup.destination.filename_prefix' => 'pre_restore_' . $timestamp . '_']);
            
            Artisan::call('backup:run', ['--only-db' => true]);
            
            // Extract the zip file
            $backupPath = Storage::path($fullPath);
            $extractPath = storage_path('app/backup-temp/' . $tenantId);
            
            if (!file_exists($extractPath)) {
                mkdir($extractPath, 0755, true);
            }
            
            // Extract the zip file
            $process = new Process(['unzip', '-o', $backupPath, '-d', $extractPath]);
            $process->setTimeout(300); 
            $process->run();
            
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            
            // Find the SQL file 
            $sqlFile = null;
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($extractPath, \RecursiveDirectoryIterator::SKIP_DOTS)
            );
            
            foreach ($iterator as $file) {
                if ($file->getExtension() === 'sql') {
                    $sqlFile = $file->getPathname();
                    break;
                }
            }
            
            if (!$sqlFile) {
                throw new \Exception('No SQL file found in the backup.');
            }
            
            // Get database connection details
            $dbConnection = config('database.default');
            $dbConfig = config('database.connections.' . $dbConnection);
            
            // Import the SQL file
            $command = sprintf(
                'mysql -h%s -P%s -u%s -p%s %s < %s',
                escapeshellarg($dbConfig['host']),
                escapeshellarg($dbConfig['port']),
                escapeshellarg($dbConfig['username']),
                escapeshellarg($dbConfig['password']),
                escapeshellarg($dbConfig['database']),
                escapeshellarg($sqlFile)
            );
            
            $process = Process::fromShellCommandline($command);
            $process->setTimeout(300); // 5 minutes
            $process->run();
            
            $this->cleanupExtractedFiles($extractPath);
            
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            
            return redirect()->back()
                ->with('success', 'Database restored successfully from backup: ' . $filename);
                
        } catch (\Exception $e) {
            Log::error('Restore failed: ' . $e->getMessage());
            
            if (isset($extractPath) && file_exists($extractPath)) {
                $this->cleanupExtractedFiles($extractPath);
            }
            
            return redirect()->back()
                ->with('error', 'Restore failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Get backup statistics
     */
    public function getStats()
    {
        $tenantId = tenant('id');
        $tenantBackupPath = $this->backupPath . $tenantId . '/SASS GARUT';
        
        $backups = collect(Storage::files($tenantBackupPath))
            ->filter(function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'zip';
            });
            
        $totalSize = $backups->sum(function ($file) {
            return Storage::size($file);
        });
        
        $latestBackup = $backups->map(function ($file) {
            return [
                'file' => $file,
                'modified' => Storage::lastModified($file)
            ];
        })->sortByDesc('modified')->first();
        
        return [
            'total_backups' => $backups->count(),
            'total_size' => $this->formatBytes($totalSize),
            'latest_backup' => $latestBackup ? Carbon::createFromTimestamp($latestBackup['modified'])->diffForHumans() : 'No backups found',
        ];
    }
    
    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    
    /**
     * Clean up extracted files
     */
    private function cleanupExtractedFiles($path)
    {
        if (!file_exists($path)) {
            return;
        }
        
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        
        rmdir($path);
    }
}