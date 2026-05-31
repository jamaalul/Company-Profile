<x-mail::message>
    # Pesanan Ditolak

    Halo **{{ $order->buyer_name }}**,

    Mohon maaf, pesanan Anda tidak dapat diproses.

    **Detail Pesanan:**
    - **Nomor Pesanan:** {{ $order->order_number }}
    - **Total:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
    - **Status:** Ditolak

    <x-mail::button :url="$trackingUrl">
        Lihat Detail Pesanan
    </x-mail::button>

    Jika Anda merasa ini adalah kesalahan, silakan hubungi admin EKRAF HIMTI.

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>