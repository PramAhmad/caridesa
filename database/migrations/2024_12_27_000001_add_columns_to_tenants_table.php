<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambahkan
            if (!Schema::hasColumn('tenants', 'is_active')) {
                $table->boolean('is_active')->default(false)->after('id');
            }
            if (!Schema::hasColumn('tenants', 'nama')) {
                $table->string('nama')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('tenants', 'email')) {
                $table->string('email')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('tenants', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('tenants', 'tujuan')) {
                $table->text('tujuan')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('tenants', 'ktp')) {
                $table->string('ktp')->nullable()->after('tujuan');
            }
            if (!Schema::hasColumn('tenants', 'surat_desa')) {
                $table->string('surat_desa')->nullable()->after('ktp');
            }
            if (!Schema::hasColumn('tenants', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('surat_desa');
            }
            if (!Schema::hasColumn('tenants', 'kota')) {
                $table->string('kota')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('tenants', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kota');
            }
            if (!Schema::hasColumn('tenants', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('tenants', 'password')) {
                $table->string('password')->nullable()->after('kelurahan');
            }
            if (!Schema::hasColumn('tenants', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'is_active', 'nama', 'email', 'phone', 'tujuan',
                'ktp', 'surat_desa', 'provinsi', 'kota', 
                'kecamatan', 'kelurahan', 'password'
            ]);
        });
    }
};