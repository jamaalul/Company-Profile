<x-mail::message>
# Uang Muka Disetujui

Halo **{{ $order->buyer_name }}**,

Uang muka (Down Payment) untuk pesanan Anda telah kami setujui. Pesanan Anda saat ini sedang diproses.

**Detail Pembayaran:**
- **Nomor Pesanan:** {{ $order->order_number }}
- **Total Harga:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
- **Uang Muka Dibayar:** Rp {{ number_format($order->amount_paid, 0, ',', '.') }}
- **Sisa Pembayaran:** Rp {{ number_format($order->remaining_balance, 0, ',', '.') }}
- **Status:** Menunggu Pelunasan

Saat pesanan Anda telah selesai diproses, silakan lakukan pembayaran sisa tagihan dan unggah bukti pelunasannya melalui tautan di bawah ini:

<x-mail::button :url="$trackingUrl">
Lacak & Lakukan Pelunasan
</x-mail::button>

Kami akan menghubungi Anda melalui email atau WhatsApp jika pesanan sudah siap atau jika ada informasi lebih lanjut.

<x-mail::panel>
**Narahubung EKRAF:**
- Alan'24: [+62 857-4802-3239](https://wa.me/6285748023239)
- Rangga'25: [+62 881-0336-33600](https://wa.me/62881033633600)
</x-mail::panel>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
