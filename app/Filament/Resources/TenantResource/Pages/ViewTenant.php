<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Notifications\Notification;
use Stancl\Tenancy\Contracts\Domain;

class ViewTenant extends ViewRecord
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->label('Approve Tenant')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => !$this->record->is_active)
                ->requiresConfirmation()
                ->modalHeading('Approve Tenant')
                ->modalDescription(fn () => 
                    "Apakah Anda yakin ingin meng-approve tenant '{$this->record->nama_desa}'? " .
                    "Domain akan dibuat dengan nama: " . 
                    TenantResource::generateDomainName($this->record->kelurahan)
                )
                ->action(function () {
                    $success = TenantResource::approveTenant($this->record);
                    
                    if ($success) {
                        $this->record->refresh();
                        return $this->redirect(
                            static::getResource()::getUrl('index'),
                            navigate: false
                        );
                    }
                }),

            Actions\EditAction::make(),
            
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Hapus Tenant')
                ->modalDescription('Apakah Anda yakin ingin menghapus tenant ini? Tindakan ini tidak dapat dibatalkan.')
                ->action(function () {
                    try {
                        Domain::where('tenant_id', $this->record->id)->delete();
                        
                        // Delete tenant
                        $this->record->delete();
                        
                        Notification::make()
                            ->title('Tenant berhasil dihapus')
                            ->success()
                            ->send();
                            
                        return $this->redirect(static::getResource()::getUrl('index'));
                        
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error')
                            ->body('Gagal menghapus tenant: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}