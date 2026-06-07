<x-mail::message>
    # Pesanan Sedang Ditinjau Ulang

    Halo **{{ $order->buyer_name }}**,

    Pesanan Anda sedang ditinjau ulang oleh admin kami.

    **Detail Pesanan:**
    - **Nomor Pesanan:** {{ $order->order_number }}
    - **Total:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
    - **Status:** Menunggu Persetujuan

    <x-mail::button :url="$trackingUrl">
        Lacak Pesanan
    </x-mail::button>

    Kami akan menghubungi Anda melalui email setelah proses peninjauan selesai.

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
