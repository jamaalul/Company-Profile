<?php

namespace App\Filament\StoreAdmin\Widgets;

use App\Models\Order;
use App\Enums\OrderStatus;
use Carbon\CarbonImmutable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;

class StoreStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $startDate = filled($this->pageFilters['startDate'] ?? null)
            ? CarbonImmutable::parse($this->pageFilters['startDate'])->startOfDay()
            : null;

        $endDate = filled($this->pageFilters['endDate'] ?? null)
            ? CarbonImmutable::parse($this->pageFilters['endDate'])->endOfDay()
            : null;

        // Chart date range: use filter range or default to last 7 days
        $chartStart = $startDate ?? now()->subDays(6)->startOfDay();
        $chartEnd = $endDate ?? now()->endOfDay();
        $dayCount = (int) $chartStart->diffInDays($chartEnd);

        $orders = Order::select('id', 'status', 'created_at', 'total_price')
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->when(! $startDate && ! $endDate, fn (Builder $query) => $query->where('created_at', '>=', $chartStart))
            ->get()
            ->groupBy(fn ($order) => $order->created_at->format('Y-m-d'));

        $charts = [
            OrderStatus::PendingApproval->value => [],
            OrderStatus::Approved->value => [],
            OrderStatus::PendingFinalPayment->value => [],
            OrderStatus::PendingFinalApproval->value => [],
            OrderStatus::Rejected->value => [],
            OrderStatus::Completed->value => [],
            'revenue' => [],
        ];

        for ($i = $dayCount; $i >= 0; $i--) {
            $date = $chartEnd->subDays($i)->format('Y-m-d');
            $dayOrders = $orders->get($date, collect());

            foreach (OrderStatus::cases() as $status) {
                $charts[$status->value][] = $dayOrders->where('status', $status->value)->count();
            }

            $charts['revenue'][] = $dayOrders->where('status', OrderStatus::Completed->value)->sum('total_price');
        }

        $dateScope = fn (Builder $query) => $query
            ->when($startDate, fn (Builder $q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $q) => $q->whereDate('created_at', '<=', $endDate));

        return [
            Stat::make('Ditolak', Order::where('status', OrderStatus::Rejected)->where($dateScope)->count())
                ->description("Pesanan ditolak")
                ->descriptionIcon(OrderStatus::Rejected->icon())
                ->color(OrderStatus::Rejected->color())
                ->chart($charts[OrderStatus::Rejected->value]),

            Stat::make('Menunggu Persetujuan', Order::where('status', OrderStatus::PendingApproval)->where($dateScope)->count())
                ->description("Pesanan menunggu persetujuan")
                ->descriptionIcon(OrderStatus::PendingApproval->icon())
                ->color(OrderStatus::PendingApproval->color())
                ->chart($charts[OrderStatus::PendingApproval->value]),

            Stat::make('Menunggu Pelunasan', Order::where('status', OrderStatus::PendingFinalPayment)->where($dateScope)->count())
                ->description("Pesanan menunggu pelunasan")
                ->descriptionIcon(OrderStatus::PendingFinalPayment->icon())
                ->color(OrderStatus::PendingFinalPayment->color())
                ->chart($charts[OrderStatus::PendingFinalPayment->value]),

            Stat::make('Menunggu Persetujuan Pelunasan', Order::where('status', OrderStatus::PendingFinalApproval)->where($dateScope)->count())
                ->description("Pesanan menunggu persetujuan pelunasan")
                ->descriptionIcon(OrderStatus::PendingFinalApproval->icon())
                ->color(OrderStatus::PendingFinalApproval->color())
                ->chart($charts[OrderStatus::PendingFinalApproval->value]),

            Stat::make('Disetujui', Order::where('status', OrderStatus::Approved)->where($dateScope)->count())
                ->description("Pesanan disetujui")
                ->descriptionIcon(OrderStatus::Approved->icon())
                ->color(OrderStatus::Approved->color())
                ->chart($charts[OrderStatus::Approved->value]),

            Stat::make('Selesai', Order::where('status', OrderStatus::Completed)->where($dateScope)->count())
                ->description("Pesanan selesai")
                ->descriptionIcon(OrderStatus::Completed->icon())
                ->color(OrderStatus::Completed->color())
                ->chart($charts[OrderStatus::Completed->value]),

            Stat::make('Total Pemasukan', 'Rp ' . number_format(Order::where('status', OrderStatus::Completed)->where($dateScope)->sum('total_price'), 0, ',', '.'))
                ->color('primary')
                ->chart($charts['revenue']),
        ];
    }
}

