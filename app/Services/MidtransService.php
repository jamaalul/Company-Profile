<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Order $order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
                'address' => $order->customer_address,
            ],
            'item_details' => []
        ];

        foreach ($order->items as $item) {
            $params['item_details'][] = [
                'id' => $item->product->sku,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        return Snap::getSnapToken($params);
    }

    public function handleNotification($request)
    {
        $notification = new Notification();

        return [
            'transaction_status' => $notification->transaction_status,
            'transaction_id' => $notification->transaction_id,
            'order_id' => $notification->order_id,
            'payment_type' => $notification->payment_type,
            'gross_amount' => $notification->gross_amount,
            'fraud_status' => $notification->fraud_status ?? null,
        ];
    }
}