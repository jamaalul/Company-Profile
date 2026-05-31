<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'special_price',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    protected function casts(): array
    {
        return [
            'special_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'bundle_items')
            ->withPivot('quantity');
    }

    public function items(): HasMany
    {
        return $this->hasMany(BundleItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
