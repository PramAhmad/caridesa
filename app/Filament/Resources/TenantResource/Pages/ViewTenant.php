<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;

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
                ->modalDescription('Apakah Anda yakin ingin meng-approve tenant ini? Domain akan dibuat otomatis.')
                ->action(function () {
                    TenantResource::approveTenant($this->record);
                    $this->redirect(static::getResource()::getUrl('index'));
                }),

            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}