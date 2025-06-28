<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TenantRegistrationController extends Controller
{
    public function index()
    {
        return view('central.tenant-registration');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'required|string|max:20',
            'tujuan' => 'required|string|max:1000',
            'ktp' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'surat_desa' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Generate tenant ID dari nama desa dengan regex clean
            $tenantId = $this->generateTenantId($request->nama_desa);

            // Upload files ke public folder
            $ktpFileName = $this->uploadFile($request->file('ktp'), 'ktp', $request->nama);
            $suratDesaFileName = $this->uploadFile($request->file('surat_desa'), 'surat_desa', $request->nama);

            // Buat tenant baru (status pending)
            $tenant = Tenant::create([
                'id' => $tenantId,
                'is_active' => false, // Pending approval
                'nama' => $request->nama,
                'nama_desa' => $request->nama_desa,
                'email' => $request->email,
                'phone' => $request->phone,
                'tujuan' => $request->tujuan,
                'ktp' => $ktpFileName,
                'surat_desa' => $suratDesaFileName,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'password' => bcrypt($request->password), // Hash password
                'data' => [
                    'tenancy_db_name' => 'tenant_' . str_replace('-', '_', $tenantId),
                    'nama_desa' => $request->nama_desa,
                    'registered_at' => now()->toISOString(),
                    'status' => 'pending_approval',
                    'generated_domain' => $this->generateDomainName($request->kelurahan)
                ]
            ]);

            return redirect('/daftar-desa/success/' . $tenant->id)
                ->with('success', 'Pendaftaran berhasil! Silakan tunggu approval dari admin.');

        } catch (\Exception $e) {
            // Cleanup uploaded files on error
            if (isset($ktpFileName) && file_exists(public_path('ktp/' . $ktpFileName))) {
                unlink(public_path('ktp/' . $ktpFileName));
            }
            if (isset($suratDesaFileName) && file_exists(public_path('surat_desa/' . $suratDesaFileName))) {
                unlink(public_path('surat_desa/' . $suratDesaFileName));
            }

            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function success($tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        return view('central.tenant-registration-success', compact('tenant'));
    }

    public function status($tenantId)
    {
        $tenant = Tenant::with('domains')->findOrFail($tenantId);
        return view('central.tenant-status', compact('tenant'));
    }

    // Helper method untuk generate tenant ID yang clean
    private function generateTenantId($namaDesa)
    {
        // Clean nama desa
        $cleanName = strtolower($namaDesa);
        $cleanName = preg_replace('/[^a-z0-9\s]/', '', $cleanName);
        $cleanName = preg_replace('/\s+/', '-', trim($cleanName));
        
        $tenantId = 'desa-' . $cleanName;
        
        // Cek unique
        $counter = 1;
        $originalId = $tenantId;
        while (Tenant::find($tenantId)) {
            $tenantId = $originalId . '-' . $counter;
            $counter++;
        }
        
        return $tenantId;
    }

    // Helper method untuk generate domain name
    private function generateDomainName($kelurahan)
    {
        $domain = strtolower($kelurahan);
        $domain = preg_replace('/[^a-z0-9\-]/', '-', $domain);
        $domain = preg_replace('/\-+/', '-', $domain);
        $domain = trim($domain, '-');
        
        if (empty($domain)) {
            $domain = 'desa-' . time();
        }
        
        return $domain;
    }

    // Helper method untuk upload file ke public folder
    private function uploadFile($file, $directory, $nama)
    {
        if (!$file) return null;
        
        try {
            // Debug: tampilkan path yang akan digunakan
            \Log::info('Upload directory: ' . $directory);
            
            // Buat nama file yang unik
            $fileName = time() . '_' . $directory . '_' . Str::slug($nama) . '.' . $file->getClientOriginalExtension();
            
            // Path tujuan langsung ke public/ktp atau public/surat_desa
            $destinationPath = public_path($directory);
            
            // Debug: tampilkan full path
            \Log::info('Destination path: ' . $destinationPath);
            
            // Buat folder jika belum ada
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
                \Log::info('Created directory: ' . $destinationPath);
            }
            
            // Move file ke public folder
            $file->move($destinationPath, $fileName);
            
            // Debug: confirm file moved
            \Log::info('File uploaded: ' . $destinationPath . '/' . $fileName);
            
            return $fileName;
            
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
            \Log::error('Directory: ' . $directory);
            \Log::error('Destination: ' . (isset($destinationPath) ? $destinationPath : 'undefined'));
            throw new \Exception('Gagal mengupload file ' . $directory . ': ' . $e->getMessage());
        }
    }
}