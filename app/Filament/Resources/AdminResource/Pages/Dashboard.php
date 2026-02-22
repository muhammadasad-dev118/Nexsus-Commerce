<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $navigationGroup = 'Analytics';

    protected function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\SalesRevenueTrend::class,
            \App\Filament\Widgets\LowStockAlerts::class,
        ];
    }
}
