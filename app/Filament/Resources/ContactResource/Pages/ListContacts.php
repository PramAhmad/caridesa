<?php
namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Contact')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Messages')
                ->badge(fn () => $this->getModel()::count()),
            
            'recent' => Tab::make('Recent (7 days)')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subDays(7)))
                ->badge(fn () => $this->getModel()::where('created_at', '>=', now()->subDays(7))->count()),
            
            'this_month' => Tab::make('This Month')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month))
                ->badge(fn () => $this->getModel()::whereMonth('created_at', now()->month)->count()),
            
            'older' => Tab::make('Older')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '<', now()->subDays(7)))
                ->badge(fn () => $this->getModel()::where('created_at', '<', now()->subDays(7))->count()),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ContactResource\Widgets\ContactStatsWidget::class,
        ];
    }
}