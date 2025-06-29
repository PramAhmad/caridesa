<?php
namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reply')
                ->label('Reply via Email')
                ->icon('heroicon-m-envelope')
                ->color('primary')
                ->url(fn (): string => "mailto:{$this->record->email}?subject=Re: Your inquiry to CariDesa&body=Dear {$this->record->name},%0D%0A%0D%0AThank you for contacting CariDesa.%0D%0A%0D%0A")
                ->openUrlInNewTab(),
            
            Actions\EditAction::make(),
            
            Actions\DeleteAction::make()
                ->requiresConfirmation(),
        ];
    }
}