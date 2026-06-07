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

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>