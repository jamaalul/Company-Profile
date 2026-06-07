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

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih telah berbelanja di HIMTI Store!<br>
{{ config('app.name') }}
</x-mail::message>