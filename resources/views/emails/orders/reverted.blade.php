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

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
