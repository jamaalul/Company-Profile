<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductField extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'label',
        'field_type',
        'dropdown_options',
        'is_required',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'dropdown_options' => 'array',
            'is_required' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItemFieldValues(): HasMany
    {
        return $this->hasMany(OrderItemFieldValue::class);
    }
}
