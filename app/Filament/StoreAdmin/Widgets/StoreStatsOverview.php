<?php

namespace App\Filament\StoreAdmin\Widgets;

use App\Models\Order;
use App\Enums\OrderStatus;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StoreStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $startDate = now()->subDays(6)->startOfDay();

        $completedOrders = Order::select('id', 'created_at', 'total_price')
            ->where('status', OrderStatus::Completed)
            ->where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(fn ($order) => $order->created_at->format('Y-m-d'));
            
        $processingOrders = Order::select('id', 'created_at')
            ->where('status', '!=', OrderStatus::Completed)
            ->where('status', '!=', OrderStatus::Rejected)
            ->where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(fn ($order) => $order->created_at->format('Y-m-d'));

        $completedChart = [];
        $processingChart = [];
        $revenueChart = [];

        $completed7Days = 0;
        $processing7Days = 0;

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            
            $completedDay = $completedOrders->get($date, collect());
            $completedCount = $completedDay->count();
            $completedChart[] = $completedCount;
            $completed7Days += $completedCount;
            
            $processingDay = $processingOrders->get($date, collect());
            $processingCount = $processingDay->count();
            $processingChart[] = $processingCount;
            $processing7Days += $processingCount;

            $revenueChart[] = $completedDay->sum('total_price');
        }

        return [
            Stat::make('Pesanan Selesai', Order::where('status', OrderStatus::Completed)->count())
            ->description("{$completed7Days} pesanan diselesaikan dalam 7 hari terakhir")
            ->descriptionIcon('heroicon-o-check-circle')
            ->color('success')
            ->chart($completedChart),
            Stat::make('Pesanan Diproses', Order::whereNotIn('status', [OrderStatus::Completed, OrderStatus::Rejected])->count())
            ->description("{$processing7Days} pesanan diproses dalam 7 hari terakhir")
            ->descriptionIcon('heroicon-o-clock')
            ->color('warning')
            ->chart($processingChart),
            Stat::make('Total Pemasukan', 'Rp ' . number_format(Order::where('status', OrderStatus::Completed)->sum('total_price'), 0, ',', '.'))
            ->description('Pemasukan 7 hari terakhir: Rp ' . number_format(array_sum($revenueChart), 0, ',', '.'))
            ->descriptionIcon('heroicon-o-currency-dollar')
            ->color('primary')
            ->chart($revenueChart),
        ];
    }
}
