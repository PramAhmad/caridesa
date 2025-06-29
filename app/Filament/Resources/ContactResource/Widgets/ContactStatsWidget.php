<?php
namespace App\Filament\Resources\ContactResource\Widgets;

use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContactStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalContacts = Contact::count();
        $todayContacts = Contact::whereDate('created_at', today())->count();
        $weekContacts = Contact::where('created_at', '>=', now()->subDays(7))->count();
        $monthContacts = Contact::whereMonth('created_at', now()->month)->count();
        
        // Calculate growth percentage for this month vs last month
        $lastMonthContacts = Contact::whereMonth('created_at', now()->subMonth()->month)->count();
        $monthGrowth = $lastMonthContacts > 0 
            ? round((($monthContacts - $lastMonthContacts) / $lastMonthContacts) * 100, 1)
            : 0;

        return [
            Stat::make('Total Messages', $totalContacts)
                ->description('All time contact messages')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),
            
            Stat::make('Today', $todayContacts)
                ->description('Messages received today')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),
            
            Stat::make('This Week', $weekContacts)
                ->description('Messages in last 7 days')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
            
            Stat::make('This Month', $monthContacts)
                ->description($monthGrowth >= 0 ? "{$monthGrowth}% increase" : "{$monthGrowth}% decrease")
                ->descriptionIcon($monthGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($monthGrowth >= 0 ? 'success' : 'danger'),
        ];
    }
}