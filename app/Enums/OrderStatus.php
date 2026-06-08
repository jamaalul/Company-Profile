<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PendingApproval = 'pending_approval';
    case Approved = 'approved';
    case PendingFinalPayment = 'pending_final_payment';
    case PendingFinalApproval = 'pending_final_approval';
    case Rejected = 'rejected';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PendingApproval => 'Menunggu Persetujuan',
            self::Approved => 'Disetujui',
            self::PendingFinalPayment => 'Menunggu Pelunasan',
            self::PendingFinalApproval => 'Menunggu Persetujuan Pelunasan',
            self::Rejected => 'Ditolak',
            self::Completed => 'Selesai',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PendingApproval => 'warning',
            self::Approved => 'info',
            self::PendingFinalPayment => 'warning',
            self::PendingFinalApproval => 'warning',
            self::Rejected => 'danger',
            self::Completed => 'success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PendingApproval => 'heroicon-o-eye',
            self::Approved => 'heroicon-o-check-circle',
            self::PendingFinalPayment => 'heroicon-o-clock',
            self::PendingFinalApproval => 'heroicon-o-document-check',
            self::Rejected => 'heroicon-o-x-circle',
            self::Completed => 'heroicon-o-check-badge',
        };
    }
}
