<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'is_active',
        'nama',
        'email',
        'phone',
        'tujuan',
        'ktp',
        'nama_desa',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'surat_desa',
        'password',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'password',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'is_active',
            'nama',
            'nama_desa',
            'email',
            'phone',
            'tujuan',
            'ktp',
            'provinsi',
            'kota',
            'kecamatan',
            'kelurahan',
            'surat_desa',
            'password',
            'data',
        ];
    }

    public function getTenancyDbNameAttribute()
    {
        return $this->data['tenancy_db_name'] ?? null;
    }

    // Scope untuk tenant aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk tenant tidak aktif
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    // Accessor untuk format nama lengkap
    public function getNamaLengkapAttribute()
    {
        return $this->nama;
    }

    // Accessor untuk alamat lengkap
    public function getAlamatLengkapAttribute()
    {
        return trim(implode(', ', array_filter([
            $this->kelurahan,
            $this->kecamatan,
            $this->kota,
            $this->provinsi
        ])));
    }

    // Method untuk mengaktifkan tenant
    public function activate()
    {
        $this->update(['is_active' => true]);
    }

    // Method untuk menonaktifkan tenant
    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    // Method untuk cek apakah tenant aktif
    public function isActive()
    {
        return $this->is_active;
    }

    // Method untuk get KTP URL
    public function getKtpUrlAttribute()
    {
        if ($this->ktp && file_exists(public_path('ktp/' . $this->ktp))) {
            return asset('ktp/' . $this->ktp);
        }
        return null;
    }

    // Method untuk get Surat Desa URL
    public function getSuratDesaUrlAttribute()
    {
        if ($this->surat_desa && file_exists(public_path('surat_desa/' . $this->surat_desa))) {
            return asset('surat_desa/' . $this->surat_desa);
        }
        return null;
    }
}
