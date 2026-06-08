<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('order_number'),
            ExportColumn::make('buyer_name'),
            ExportColumn::make('buyer_email'),
            ExportColumn::make('buyer_whatsapp'),
            ExportColumn::make('total_price'),
            ExportColumn::make('status'),
            ExportColumn::make('payment_type'),
            ExportColumn::make('amount_paid'),
            ExportColumn::make('final_payment_proof_path'),
            ExportColumn::make('is_preorder'),
            ExportColumn::make('payment_proof_path'),
            ExportColumn::make('paid_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
