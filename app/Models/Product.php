<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'price',
        'stock',
        'is_active',
        'is_preorder',
    ];

    protected $attributes = [
        'stock' => 0,
        'is_active' => true,
        'is_preorder' => false,
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_preorder' => 'boolean',
        ];
    }

    public function fields(): HasMany
    {
        return $this->hasMany(ProductField::class)->orderBy('sort_order');
    }

    public function bundles(): BelongsToMany
    {
        return $this->belongsToMany(Bundle::class, 'bundle_items')
            ->withPivot('quantity');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                  ->orWhere('is_preorder', true);
            });
    }
}
