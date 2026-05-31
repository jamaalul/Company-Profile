<x-mail::message>
    # Pesanan Selesai

    Halo **{{ $order->buyer_name }}**,

    Pesanan Anda telah selesai diproses!

    **Detail Pesanan:**
    - **Nomor Pesanan:** {{ $order->order_number }}
    - **Total:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
    - **Status:** Selesai

    <x-mail::button :url="$trackingUrl">
        Lihat Detail Pesanan
    </x-mail::button>

    Terima kasih telah berbelanja di HIMTI Store!<br>
    {{ config('app.name') }}
</x-mail::message>