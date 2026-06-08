<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'tracking_token',
        'buyer_name',
        'buyer_email',
        'buyer_whatsapp',
        'total_price',
        'status',
        'payment_type',
        'amount_paid',
        'payment_proof_path',
        'final_payment_proof_path',
        'paid_at',
        'is_preorder',
    ];

    protected $hidden = [
        'tracking_token',
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'paid_at' => 'datetime',
            'total_price' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'is_preorder' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::updated(function (Order $order) {
            if ($order->isDirty('status') && in_array($order->status, [OrderStatus::Completed, OrderStatus::Rejected])) {
                $order->loadMissing('items.fieldValues');
                foreach ($order->items as $item) {
                    foreach ($item->fieldValues as $fieldValue) {
                        if ($fieldValue->file_path) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($fieldValue->file_path);
                            $fieldValue->update(['file_path' => null]);
                        }
                    }
                }
            }
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTrackingUrl(): string
    {
        return route('marketplace.track', $this->tracking_token);
    }

    public function getRemainingBalanceAttribute(): float
    {
        return max(0, $this->total_price - ($this->amount_paid ?? 0));
    }

    public static function generateOrderNumber(): string
    {
        $today = now()->format('Ymd');
        $count = static::whereDate('created_at', today())->count() + 1;

        return 'HIMTI-' . $today . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
