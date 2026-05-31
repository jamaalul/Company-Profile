<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemFieldValue extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_item_id',
        'product_field_id',
        'value',
        'file_path',
        'copy_index',
    ];

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function productField(): BelongsTo
    {
        return $this->belongsTo(ProductField::class);
    }
}
