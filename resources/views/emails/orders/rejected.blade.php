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

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>