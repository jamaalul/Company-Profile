<?php

namespace App\Filament\StoreAdmin\Resources\OrderResource\Pages;

use App\Filament\StoreAdmin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Mail\OrderApprovedMail;
use App\Mail\OrderRejectedMail;
use App\Mail\OrderCompletedMail;
use App\Mail\OrderRevertedMail;
use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Mail;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('approve')
                ->label('Setujui')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->form([
                    Forms\Components\Select::make('payment_type')
                        ->label('Tipe Pembayaran')
                        ->options([
                            'full' => 'Lunas (Full Payment)',
                            'down_payment' => 'Uang Muka (Down Payment)',
                        ])
                        ->required()
                        ->live(),
                    Forms\Components\TextInput::make('amount_paid')
                        ->label('Jumlah yang Dibayar')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(fn (Get $get) => $get('payment_type') === 'down_payment')
                        ->visible(fn (Get $get) => $get('payment_type') === 'down_payment')
                        ->helperText(function (Order $record) {
                            return 'Minimal DP: Rp ' . number_format($record->total_price * 0.5, 0, ',', '.');
                        })
                        ->rules([
                            function (Order $record, Get $get) {
                                return function (string $attribute, $value, \Closure $fail) use ($record, $get) {
                                    if ($get('payment_type') === 'down_payment' && $value < ($record->total_price * 0.5)) {
                                        $fail('Uang muka minimal 50% dari total harga.');
                                    }
                                };
                            },
                        ]),
                ])
                ->visible(fn (Order $record) => $record->status === OrderStatus::PendingApproval)
                ->action(function (array $data, Order $record) {
                    $newStatus = $data['payment_type'] === 'down_payment' ? OrderStatus::PendingFinalPayment : OrderStatus::Approved;
                    $amountPaid = $data['payment_type'] === 'full' ? $record->total_price : $data['amount_paid'];

                    $record->update([
                        'status' => $newStatus,
                        'payment_type' => $data['payment_type'],
                        'amount_paid' => $amountPaid,
                    ]);
                    if ($newStatus === OrderStatus::PendingFinalPayment) {
                        Mail::to($record->buyer_email)->send(new \App\Mail\OrderDownPaymentApprovedMail($record));
                    } else {
                        Mail::to($record->buyer_email)->send(new OrderApprovedMail($record));
                    }
                }),
            Actions\Action::make('reject')
                ->label('Tolak')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn (Order $record) => $record->status === OrderStatus::PendingApproval)
                ->action(function (Order $record) {
                    $record->update(['status' => OrderStatus::Rejected]);
                    foreach ($record->items as $item) {
                        if ($item->orderable_type === 'product' && $item->product && $item->product->is_preorder == 0) {
                            $item->product->increment('stock', $item->quantity);
                        } elseif ($item->orderable_type === 'bundle' && $item->bundle && $item->bundle->is_preorder == 0) {
                            foreach ($item->bundle->items as $bundleItem) {
                                $bundleItem->product->increment('stock', $bundleItem->quantity * $item->quantity);
                            }
                        }
                    }
                    Mail::to($record->buyer_email)->send(new OrderRejectedMail($record));
                }),
            Actions\Action::make('approve_final')
                ->label('Setujui Pelunasan')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (Order $record) => $record->status === OrderStatus::PendingFinalApproval)
                ->action(function (Order $record) {
                    $record->update(['status' => OrderStatus::Approved]);
                    Mail::to($record->buyer_email)->send(new \App\Mail\OrderFinalPaymentApprovedMail($record));
                }),
            Actions\Action::make('reach_out_payment')
                ->label('Tagih Pelunasan')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->color('warning')
                ->visible(fn (Order $record) => $record->status === OrderStatus::PendingFinalPayment)
                ->url(function (Order $record) {
                    $phone = ltrim(preg_replace('/[^0-9]/', '', $record->buyer_whatsapp), '0');
                    if (!str_starts_with($phone, '62')) {
                        $phone = '62' . $phone;
                    }
                    $trackingUrl = $record->getTrackingUrl();
                    $message = "Halo {$record->buyer_name},\n\nPesanan Anda dengan nomor {$record->order_number} sedang menunggu pelunasan. Silakan cek status pesanan dan lakukan pembayaran pelunasan melalui link berikut:\n\n{$trackingUrl}\n\nTerima kasih,\nHIMTI Store.";
                    return "https://wa.me/{$phone}?text=" . urlencode($message);
                })
                ->openUrlInNewTab(),
            Actions\Action::make('complete')
                ->label('Selesai')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (Order $record) => $record->status === OrderStatus::Approved)
                ->action(function (Order $record) {
                    $record->update(['status' => OrderStatus::Completed]);
                    Mail::to($record->buyer_email)->send(new OrderCompletedMail($record));
                }),
            Actions\Action::make('revert')
                ->label('Batal Setuju')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn (Order $record) => in_array($record->status, [OrderStatus::Approved, OrderStatus::PendingFinalPayment, OrderStatus::PendingFinalApproval]))
                ->action(function (Order $record) {
                    $record->update(['status' => OrderStatus::PendingApproval]);
                    Mail::to($record->buyer_email)->send(new OrderRevertedMail($record));
                }),
        ];
    }
}
