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

        $orders = Order::select('id', 'status', 'created_at', 'total_price')
            ->where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(fn ($order) => $order->created_at->format('Y-m-d'));

        $charts = [
            OrderStatus::PendingApproval->value => [],
            OrderStatus::Approved->value => [],
            OrderStatus::Rejected->value => [],
            OrderStatus::Completed->value => [],
            'revenue' => [],
        ];

        $counts7Days = [
            OrderStatus::PendingApproval->value => 0,
            OrderStatus::Approved->value => 0,
            OrderStatus::Rejected->value => 0,
            OrderStatus::Completed->value => 0,
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayOrders = $orders->get($date, collect());
            
            foreach (OrderStatus::cases() as $status) {
                $statusOrders = $dayOrders->where('status', $status->value);
                $count = $statusOrders->count();
                $charts[$status->value][] = $count;
                $counts7Days[$status->value] += $count;
            }

            $charts['revenue'][] = $dayOrders->where('status', OrderStatus::Completed->value)->sum('total_price');
        }

        return [
            Stat::make('Menunggu Persetujuan', Order::where('status', OrderStatus::PendingApproval)->count())
                ->description("{$counts7Days[OrderStatus::PendingApproval->value]} pesanan dalam 7 hari terakhir")
                ->descriptionIcon(OrderStatus::PendingApproval->icon())
                ->color(OrderStatus::PendingApproval->color())
                ->chart($charts[OrderStatus::PendingApproval->value]),

            Stat::make('Disetujui', Order::where('status', OrderStatus::Approved)->count())
                ->description("{$counts7Days[OrderStatus::Approved->value]} pesanan dalam 7 hari terakhir")
                ->descriptionIcon(OrderStatus::Approved->icon())
                ->color(OrderStatus::Approved->color())
                ->chart($charts[OrderStatus::Approved->value]),

            Stat::make('Ditolak', Order::where('status', OrderStatus::Rejected)->count())
                ->description("{$counts7Days[OrderStatus::Rejected->value]} pesanan dalam 7 hari terakhir")
                ->descriptionIcon(OrderStatus::Rejected->icon())
                ->color(OrderStatus::Rejected->color())
                ->chart($charts[OrderStatus::Rejected->value]),

            Stat::make('Selesai', Order::where('status', OrderStatus::Completed)->count())
                ->description("{$counts7Days[OrderStatus::Completed->value]} pesanan dalam 7 hari terakhir")
                ->descriptionIcon(OrderStatus::Completed->icon())
                ->color(OrderStatus::Completed->color())
                ->chart($charts[OrderStatus::Completed->value]),

            Stat::make('Total Pemasukan', 'Rp ' . number_format(Order::where('status', OrderStatus::Completed)->sum('total_price'), 0, ',', '.'))
                ->description('Pemasukan 7 hari terakhir: Rp ' . number_format(array_sum($charts['revenue']), 0, ',', '.'))
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('primary')
                ->chart($charts['revenue']),
        ];
    }
}
