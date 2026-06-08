<x-mail::message>
# Pelunasan Disetujui

Halo **{{ $order->buyer_name }}**,

Pembayaran pelunasan untuk pesanan Anda telah kami terima dan disetujui. Pesanan Anda kini telah sepenuhnya lunas!

**Detail Pembayaran:**
- **Nomor Pesanan:** {{ $order->order_number }}
- **Total Harga:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
- **Status:** Selesai

Anda dapat melihat detail pesanan Anda melalui tautan berikut:

<x-mail::button :url="$trackingUrl">
Lihat Pesanan
</x-mail::button>

Jika Anda memiliki pertanyaan mengenai pengiriman atau pengambilan barang, silakan hubungi kami.

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih telah berbelanja di HIMTI STORE,<br>
{{ config('app.name') }}
</x-mail::message>
