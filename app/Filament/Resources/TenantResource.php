<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Jobs\SeedTenantJob;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Kelola Tenant';
    protected static ?string $modelLabel = 'Tenant Desa';
    protected static ?string $pluralModelLabel = 'Tenant Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Desa')
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->label('Tenant ID')
                            ->disabled()
                            ->visible(fn ($record) => $record !== null),

                        Forms\Components\TextInput::make('nama_desa')
                            ->label('Nama Desa')
                            ->disabled()
                            ->visible(fn ($record) => $record !== null),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Penanggung Jawab')
                            ->disabled(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->disabled(),

                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->disabled(),

                        Forms\Components\Textarea::make('tujuan')
                            ->label('Tujuan Pembuatan Website')
                            ->disabled()
                            ->rows(3),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Alamat')
                    ->schema([
                        Forms\Components\TextInput::make('provinsi')
                            ->label('Provinsi')
                            ->disabled(),

                        Forms\Components\TextInput::make('kota')
                            ->label('Kota/Kabupaten')
                            ->disabled(),

                        Forms\Components\TextInput::make('kecamatan')
                            ->label('Kecamatan')
                            ->disabled(),

                        Forms\Components\TextInput::make('kelurahan')
                            ->label('Kelurahan/Desa')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Dokumen Pendukung')
                    ->schema([
                        // KTP Preview
                        Forms\Components\Placeholder::make('ktp_preview')
                            ->label('KTP')
                            ->content(function ($record) {
                                if (!$record || !$record->ktp) {
                                    return new \Illuminate\Support\HtmlString('<p class="text-gray-500">Dokumen KTP tidak tersedia</p>');
                                }
                                
                                $url = $record->ktp_url;
                                $fileName = $record->ktp;
                                $isImage = str_contains($fileName, '.jpg') || str_contains($fileName, '.jpeg') || str_contains($fileName, '.png');
                                
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="text-sm font-semibold text-gray-900">KTP - ' . $record->nama . '</h4>
                                            <div class="flex items-center space-x-2">
                                                <a href="' . $url . '" target="_blank" class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                    Buka
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center bg-white rounded border-2 border-dashed border-gray-300 p-6">' .
                                            ($isImage ? 
                                                '<img src="' . $url . '" alt="KTP" class="max-w-full max-h-48 mx-auto rounded shadow">' :
                                                '<div class="flex flex-col items-center">
                                                    <svg class="w-16 h-16 text-red-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <p class="text-sm text-gray-600 mb-2">' . $fileName . '</p>
                                                    <p class="text-xs text-gray-500">File PDF</p>
                                                </div>'
                                            ) .
                                        '</div>
                                    </div>'
                                );
                            }),

                        // Surat Desa Preview
                        Forms\Components\Placeholder::make('surat_desa_preview')
                            ->label('Surat Desa')
                            ->content(function ($record) {
                                if (!$record || !$record->surat_desa) {
                                    return new \Illuminate\Support\HtmlString('<p class="text-gray-500">Dokumen Surat Desa tidak tersedia</p>');
                                }
                                
                                $url = $record->surat_desa_url;
                                $fileName = $record->surat_desa;
                                $isImage = str_contains($fileName, '.jpg') || str_contains($fileName, '.jpeg') || str_contains($fileName, '.png');
                                
                                return new \Illuminate\Support\HtmlString(
                                    '<div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="text-sm font-semibold text-gray-900">Surat Desa - ' . $record->nama . '</h4>
                                            <div class="flex items-center space-x-2">
                                                <a href="' . $url . '" target="_blank" class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                    Buka
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center bg-white rounded border-2 border-dashed border-gray-300 p-6">' .
                                            ($isImage ? 
                                                '<img src="' . $url . '" alt="Surat Desa" class="max-w-full max-h-48 mx-auto rounded shadow">' :
                                                '<div class="flex flex-col items-center">
                                                    <svg class="w-16 h-16 text-red-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <p class="text-sm text-gray-600 mb-2">' . $fileName . '</p>
                                                    <p class="text-xs text-gray-500">File PDF</p>
                                                </div>'
                                            ) .
                                        '</div>
                                    </div>'
                                );
                            }),
                    ])
                    ->columns(1)
                    ->visible(fn ($record) => $record && ($record->ktp || $record->surat_desa)),

                Forms\Components\Section::make('Status Approval')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Aktifkan tenant setelah verifikasi dokumen')
                            ->live()
                            ->afterStateUpdated(function ($state, $record) {
                                if ($record && $state) {
                                    // Buat domain terlebih dahulu
                                    self::createDomainForTenant($record);
                                    
                                    // Kemudian jalankan seeding
                                    SeedTenantJob::dispatch($record);
                                    
                                    Notification::make()
                                        ->title('Tenant diaktifkan')
                                        ->body('Domain telah dibuat dan proses seeding dimulai.')
                                        ->success()
                                        ->send();
                                }
                            }),

                        Forms\Components\Textarea::make('data.admin_notes')
                            ->label('Catatan Admin')
                            ->helperText('Catatan internal untuk tenant ini')
                            ->rows(3),

                        Forms\Components\DateTimePicker::make('data.approved_at')
                            ->label('Tanggal Approval')
                            ->disabled()
                            ->visible(fn ($record) => $record && $record->is_active),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Tenant ID')
                    ->searchable()
                    ->copyable()
                    ->size('sm'),

                Tables\Columns\TextColumn::make('nama_desa')
                    ->label('Nama Desa')
                    ->searchable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Penanggung Jawab')
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->size('sm'),

                Tables\Columns\TextColumn::make('alamat_lengkap')
                    ->label('Alamat')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->alamat_lengkap),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                // Preview Dokumen Column
                Tables\Columns\ViewColumn::make('documents')
                    ->label('Dokumen')
                    ->view('filament.columns.document-status')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('domains.domain')
                    ->label('Domain')
                    ->searchable()
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn ($state) => $state ? $state : 'Belum dibuat'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl. Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Pending',
                    ]),

                Tables\Filters\SelectFilter::make('provinsi')
                    ->label('Provinsi')
                    ->options(function () {
                        return Tenant::distinct()
                            ->whereNotNull('provinsi')
                            ->pluck('provinsi', 'provinsi')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail'),

                // Quick Preview Action
                Tables\Actions\Action::make('preview_documents')
                    ->label('Preview Dokumen')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->color('info')
                    ->modalHeading(fn ($record) => 'Dokumen - ' . $record->nama_desa)
                    ->modalContent(fn ($record) => view('filament.modals.document-preview-modal', compact('record')))
                    ->modalWidth('7xl')
                    ->visible(fn ($record) => $record->ktp || $record->surat_desa),

                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_active)
                    ->requiresConfirmation()
                    ->modalHeading('Approve Tenant')
                    ->modalDescription('Apakah Anda yakin ingin meng-approve tenant ini? Domain akan dibuat otomatis.')
                    ->action(function ($record) {
                        self::approveTenant($record);
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => !$record->is_active)
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Tenant')
                    ->modalDescription('Apakah Anda yakin ingin menolak tenant ini?')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function ($record, array $data) {
                        self::rejectTenant($record, $data['rejection_reason']);
                    }),

                Tables\Actions\EditAction::make()
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approve Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if (!$record->is_active) {
                                    self::approveTenant($record);
                                }
                            }
                        }),

                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
            'view' => Pages\ViewTenant::route('/{record}'),
        ];
    }

    // Method untuk approve tenant
    public static function approveTenant($record)
    {
        try {
            // Update status aktif
            $record->update([
                'is_active' => true,
                'data' => array_merge($record->data ?? [], [
                    'approved_at' => now()->toISOString(),
                    'approved_by' => auth()->user()->name ?? 'Admin',
                    'status' => 'approved'
                ])
            ]);

            // Buat domain
            self::createDomainForTenant($record);

            // Jalankan seeding job
            SeedTenantJob::dispatch($record);

            Notification::make()
                ->title('Tenant berhasil diapprove')
                ->body("Tenant {$record->nama_desa} telah diaktifkan, domain dibuat, dan proses seeding dimulai.")
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Gagal approve tenant: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    // Method untuk reject tenant
    public static function rejectTenant($record, $reason)
    {
        try {
            $record->update([
                'is_active' => false,
                'data' => array_merge($record->data ?? [], [
                    'rejected_at' => now()->toISOString(),
                    'rejected_by' => auth()->user()->name ?? 'Admin',
                    'rejection_reason' => $reason,
                    'status' => 'rejected'
                ])
            ]);

            Notification::make()
                ->title('Tenant ditolak')
                ->body("Tenant {$record->nama_desa} telah ditolak.")
                ->warning()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Gagal menolak tenant: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    // Method untuk membuat domain dari nama kelurahan
    public static function createDomainForTenant($record)
    {
       Domain::create([
            'domain' => self::generateDomainName($record->kelurahan),
            'tenant_id' => $record->id,
        ]);

        $record->update([
            'data' => array_merge($record->data ?? [], [
                'generated_domain' => self::generateDomainName($record->kelurahan)
            ])
        ]);
    }

    // Method untuk generate domain name yang clean
    public static function generateDomainName($input)
    {
        // Convert ke lowercase
        $domain = strtolower($input);
        
        // Replace spasi dan karakter khusus dengan dash
        $domain = preg_replace('/[^a-z0-9\-]/', '-', $domain);
        
        // Remove multiple dashes
        $domain = preg_replace('/\-+/', '-', $domain);
        
        // Remove leading/trailing dashes
        $domain = trim($domain, '-');
        
        // Pastikan tidak kosong
        if (empty($domain)) {
            dd('Domain name cannot be empty. Please provide a valid kelurahan name.');
        }
        

        // Pastikan tidak terlalu panjang (max 63 karakter untuk subdomain)
        if (strlen($domain) > 50) {
            $domain = substr($domain, 0, 50);
            $domain = rtrim($domain, '-');
        }
        
        return $domain.'.'.config('app.domain');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', false)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('is_active', false)->count() > 0 ? 'warning' : null;
    }
}