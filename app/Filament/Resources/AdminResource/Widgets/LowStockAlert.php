<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\ProductVariant;

class LowStockAlerts extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        $lowStock = ProductVariant::where('stock', '<=', 5)->count();

        return [
            Card::make('Low Stock Products', $lowStock),
        ];
    }
}