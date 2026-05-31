<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'bundle_id',
        'orderable_type',
        'quantity',
        'unit_price',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::created(function (OrderItem $item) {
            $isPreorder = false;
            
            if ($item->orderable_type === 'product') {
                $isPreorder = $item->product?->is_preorder ?? false;
            } elseif ($item->orderable_type === 'bundle') {
                $isPreorder = $item->bundle?->products()->where('is_preorder', true)->exists() ?? false;
            }

            if ($isPreorder) {
                $item->order()->update(['is_preorder' => true]);
            }
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function bundle(): BelongsTo
    {
        return $this->belongsTo(Bundle::class);
    }

    public function fieldValues(): HasMany
    {
        return $this->hasMany(OrderItemFieldValue::class);
    }



    /**
     * Get the display name of the orderable item (product or bundle).
     */
    public function getItemName(): string
    {
        if ($this->orderable_type === 'bundle' && $this->bundle) {
            return $this->bundle->name;
        }

        return $this->product?->name ?? 'Produk dihapus';
    }
}
