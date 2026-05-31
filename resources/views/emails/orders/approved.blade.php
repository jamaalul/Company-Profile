<x-mail::message>
    # Pesanan Disetujui

    Halo **{{ $order->buyer_name }}**,

    Pesanan Anda telah disetujui dan sedang diproses!

    **Detail Pesanan:**
    - **Nomor Pesanan:** {{ $order->order_number }}
    - **Total:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
    - **Status:** Disetujui

    <x-mail::button :url="$trackingUrl">
        Lacak Pesanan
    </x-mail::button>

    Kami akan menghubungi Anda melalui email jika ada informasi lebih lanjut.

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>