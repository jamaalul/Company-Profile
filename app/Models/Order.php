<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'angkatan',
        'bidang',
        'size',
        'payment_method',
        'payment_proof',
        'total_amount',
        'status',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePendingConfirmation($query)
    {
        return $query->where('status', 'pending_confirmation');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending_confirmation' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Menunggu Konfirmasi'],
            'confirmed' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Dikonfirmasi'],
            'paid' => ['class' => 'bg-blue-100 text-blue-800', 'text' => 'Lunas'],
            'rejected' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Ditolak'],
            'pending' => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Pending'],
        ];

        return $badges[$this->status] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => ucfirst($this->status)];
    }

    public function canBeConfirmed()
    {
        return $this->status === 'pending_confirmation';
    }

    public function canBeRejected()
    {
        return in_array($this->status, ['pending_confirmation', 'confirmed']);
    }
}