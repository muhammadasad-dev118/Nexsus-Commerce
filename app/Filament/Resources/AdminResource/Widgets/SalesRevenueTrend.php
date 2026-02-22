<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget; 
use Illuminate\Support\Carbon;

class SalesRevenueTrend extends ChartWidget
{
    protected static ?string $heading = 'Sales Revenue (Last 30 Days)';

  
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = [];
       
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            
           
            $total = Order::whereDate('created_at', $date)->sum('total_amount');
            
            
            $data[$date] = (float) $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue ($)',
                    'data' => array_values($data),
                    'fill' => 'start', 
                    'borderColor' => '#3b82f6', 
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)', 
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        
        return 'line';
    }
}