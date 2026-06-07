<x-mail::message>
# Pesanan Berhasil Dibuat

Halo **{{ $order->buyer_name }}**,

Terima kasih telah berbelanja di HIMTI Store! Pesanan Anda telah berhasil dibuat.

**Detail Pesanan:**
- **Nomor Pesanan:** {{ $order->order_number }}
- **Total:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
- **Status:** Menunggu Konfirmasi

Anda dapat melacak status pesanan Anda melalui link berikut:

<x-mail::button :url="$trackingUrl">
Lacak Pesanan
</x-mail::button>

Admin sedang melakukan verifikasi bukti pembayaran yang anda berikan. Anda akan mendapatkan notifikasi email
setelah proses verifikasi selesai.

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>