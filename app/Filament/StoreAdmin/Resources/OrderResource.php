<?php

namespace App\Filament\StoreAdmin\Resources;

use App\Filament\StoreAdmin\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Mail\OrderApprovedMail;
use App\Mail\OrderRejectedMail;
use App\Mail\OrderCompletedMail;
use App\Mail\OrderRevertedMail;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Filament\Schemas\Components\Section;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shopping-cart';
    protected static string|\UnitEnum|null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('buyer_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('buyer_whatsapp')
                    ->searchable()
                    ->url(fn (Order $record): string => 'https://wa.me/' . ltrim(preg_replace('/[^0-9]/', '', $record->buyer_whatsapp), '0') . '?text=Halo%20' . urlencode($record->buyer_name) . ',%20dari%20HIMTI%20Store.')
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (OrderStatus $state): string => $state->color())
                    ->formatStateUsing(fn (OrderStatus $state): string => $state->label()),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(collect(OrderStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()]))
                    ->multiple(),
                Tables\Filters\TernaryFilter::make('is_preorder')
                    ->label('Pre-Order')
                    ->placeholder('Semua Pesanan')
                    ->trueLabel('Hanya Pre-Order')
                    ->falseLabel('Bukan Pre-Order'),
                Filter::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn ($q, $date) => $q->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn ($q, $date) => $q->whereDate('created_at', '<=', $date)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = 'Dari: ' . \Carbon\Carbon::parse($data['created_from'])->format('d/m/Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = 'Sampai: ' . \Carbon\Carbon::parse($data['created_until'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                ViewAction::make(),
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Order $record) => $record->status === OrderStatus::PendingApproval)
                    ->action(function (Order $record) {
                        $record->update(['status' => OrderStatus::Approved]);
                        Mail::to($record->buyer_email)->send(new OrderApprovedMail($record));
                    }),
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Order $record) => $record->status === OrderStatus::PendingApproval)
                    ->action(function (Order $record) {
                        $record->update(['status' => OrderStatus::Rejected]);
                        foreach ($record->items as $item) {
                            if ($item->orderable_type === 'product' && $item->product) {
                                $item->product->increment('stock', $item->quantity);
                            } elseif ($item->orderable_type === 'bundle' && $item->bundle) {
                                foreach ($item->bundle->items as $bundleItem) {
                                    $bundleItem->product->increment('stock', $bundleItem->quantity * $item->quantity);
                                }
                            }
                        }
                        Mail::to($record->buyer_email)->send(new OrderRejectedMail($record));
                    }),
                Action::make('complete')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Order $record) => $record->status === OrderStatus::Approved)
                    ->action(function (Order $record) {
                        $record->update(['status' => OrderStatus::Completed]);
                        Mail::to($record->buyer_email)->send(new OrderCompletedMail($record));
                    }),
                Action::make('revert')
                    ->label('Batal Setuju')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn (Order $record) => $record->status === OrderStatus::Approved)
                    ->action(function (Order $record) {
                        $record->update(['status' => OrderStatus::PendingApproval]);
                        Mail::to($record->buyer_email)->send(new OrderRevertedMail($record));
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Data Pembeli')
                    ->schema([
                        Infolists\Components\TextEntry::make('buyer_name')->label('Nama'),
                        Infolists\Components\TextEntry::make('buyer_email')->label('Email'),
                        Infolists\Components\TextEntry::make('buyer_whatsapp')->label('WhatsApp'),
                        Infolists\Components\TextEntry::make('order_number')->label('No. Pesanan'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (OrderStatus $state): string => $state->color())
                            ->formatStateUsing(fn (OrderStatus $state): string => $state->label()),
                        Infolists\Components\TextEntry::make('created_at')->dateTime()->label('Tanggal Pesan'),
                    ])->columns(3),

                Section::make('Pembayaran')
                    ->schema([
                        Infolists\Components\TextEntry::make('total_price')
                            ->money('IDR', locale: 'id')
                            ->label('Total Bayar'),
                        Infolists\Components\TextEntry::make('paid_at')
                            ->dateTime()
                            ->label('Waktu Bayar'),
                        Infolists\Components\TextEntry::make('payment_proof_path')
                            ->label('Bukti Pembayaran')
                            ->html()
                            ->formatStateUsing(function ($state) {
                                if (!$state) return '-';
                                $url = asset('storage/' . $state);
                                return "<a href=\"{$url}\" target=\"_blank\" style=\"display: inline-block; padding: 0.5rem 1rem; background-color: #3b82f6; color: #ffffff; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem; font-weight: 500;\">Lihat Bukti Pembayaran</a>";
                            })
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Item Pesanan')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('item_name')
                                    ->label('Produk/Bundle')
                                    ->state(fn ($record) => $record->getItemName()),
                                Infolists\Components\TextEntry::make('quantity')
                                    ->label('Jumlah'),
                                Infolists\Components\TextEntry::make('unit_price')
                                    ->money('IDR', locale: 'id')
                                    ->label('Harga Satuan'),
                                Infolists\Components\RepeatableEntry::make('fieldValues')
                                    ->label('Data Tambahan')
                                    ->schema([
                                        Infolists\Components\TextEntry::make('productField.label')
                                            ->label('Field'),
                                        Infolists\Components\TextEntry::make('value')
                                            ->label('Nilai')
                                            ->getStateUsing(fn ($record) => $record->productField->field_type === 'file' ? 'file' : $record->value)
                                            ->html() // <-- add this
                                            ->formatStateUsing(function ($state, $record) {
                                                if ($record->productField->field_type === 'file') {
                                                    $url = asset('storage/' . $record->file_path);
                                                    return "<div class=\"flex space-x-3\">" .
                                                        "<a href=\"{$url}\" target=\"_blank\" style=\"display: inline-block; padding: 0.25rem 0.75rem; background-color: #3b82f6; color: #ffffff; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;\">Lihat File</a>" .
                                                        "<a href=\"{$url}\" download style=\"display: inline-block; padding: 0.25rem 0.75rem; background-color: #10b981; color: #ffffff; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem; margin-left: 0.75rem;\">Download</a>" .
                                                        "</div>";
                                                }
                                                return $state;
                                            }),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}