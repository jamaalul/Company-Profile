<?php

namespace App\Filament\StoreAdmin\Widgets;

use App\Enums\OrderStatus;
use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PendingProductsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $singleProductsQuery = DB::table('order_items')
            ->select('product_id', 'quantity as total_quantity')
            ->where('orderable_type', 'product')
            ->whereExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('orders')
                    ->whereColumn('order_items.order_id', 'orders.id')
                    ->whereNotIn('status', [OrderStatus::Completed->value, OrderStatus::Rejected->value]);
            });

        $bundleProductsQuery = DB::table('order_items')
            ->join('bundle_items', 'order_items.bundle_id', '=', 'bundle_items.bundle_id')
            ->select('bundle_items.product_id', DB::raw('(order_items.quantity * bundle_items.quantity) as total_quantity'))
            ->where('order_items.orderable_type', 'bundle')
            ->whereExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('orders')
                    ->whereColumn('order_items.order_id', 'orders.id')
                    ->whereNotIn('status', [OrderStatus::Completed->value, OrderStatus::Rejected->value]);
            });

        $unionQuery = $singleProductsQuery->unionAll($bundleProductsQuery);

        $aggregatedQuery = DB::table(DB::raw("({$unionQuery->toSql()}) as combined_products"))
            ->mergeBindings($unionQuery)
            ->select('product_id', DB::raw('SUM(total_quantity) as total_quantity'))
            ->groupBy('product_id');

        return $table
            ->query(
                Product::query()
                    ->joinSub($aggregatedQuery, 'aggregated', function ($join) {
                        $join->on('products.id', '=', 'aggregated.product_id');
                    })
                    ->select('products.*', 'aggregated.total_quantity')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk'),
                Tables\Columns\TextColumn::make('total_quantity')
                    ->label('Jumlah')
                    ->numeric(),
            ])
            ->defaultSort('total_quantity', 'desc')
            ->paginated(false)
            ->heading('Produk Belum Selesai')
            ->description('Daftar produk pada pesanan yang belum selesai.');
    }
}