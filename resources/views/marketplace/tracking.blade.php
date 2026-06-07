@extends('layouts.app-plain')

@section('title', 'Lacak Pesanan - HIMTI STORE')

@section('content')
    <section class="flex justify-center items-center bg-slate-100 py-12 min-h-screen font-sans">
        <div class="px-4 w-full max-w-md">
            <!-- Receipt Card -->
            <div class="relative bg-white shadow-xl rounded-lg overflow-hidden">

                <!-- Top Section / Header -->
                <div class="relative bg-white p-6 border-gray-200 border-b-2 border-dashed text-center">
                    <h1 class="font-bold text-gray-900 text-2xl uppercase tracking-widest">Pesanan</h1>
                    <p class="mt-1 font-medium text-gray-500 text-sm tracking-wide">HIMTI STORE</p>

                </div>

                <!-- Body Section -->
                <div class="relative bg-white p-6">
                    <div class="mb-6 text-center">
                        <h2 class="font-semibold text-gray-800 text-lg">Pesanan Berhasil Dibuat!</h2>
                        <p class="mt-2 text-gray-500 text-sm">Anda dapat melihat status pesanan pada detail di bawah.
                            Hubungi narahubung jika terkendala.</p>
                    </div>

                    <!-- Order Details List -->
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center pb-3 border-gray-200 border-b border-dashed">
                            <span class="text-gray-500">Nomor Pesanan</span>
                            <span class="font-mono font-medium text-gray-900">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-gray-200 border-b border-dashed">
                            <span class="text-gray-500">Nama Pemesan</span>
                            <span class="font-medium text-gray-900">{{ $order->buyer_name }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-gray-200 border-b border-dashed">
                            <span class="text-gray-500">Status</span>
                            <span
                                class="inline-flex items-center rounded-full text-xs font-medium bg-{{ $order->status->color() }}-100 text-{{ $order->status->color() }}-800">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-bold text-gray-700 text-xs uppercase tracking-wider">Total Pembayaran</span>
                            <span class="font-bold text-blue-700 text-lg">Rp
                                {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="relative bg-gray-50 p-6 border-gray-200 border-t-2 border-dashed">

                    <!-- Contact Details -->
                    <div class="bg-blue-50/50 p-4 border border-blue-100 rounded-lg">
                        <h4 class="mb-3 font-bold text-gray-800 text-xs uppercase tracking-wider">Narahubung EKRAF:</h4>
                        <div class="space-y-2 text-gray-600 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-700">Alan’24</span>
                                <a href="https://wa.me/+6285748023239"
                                    class="inline-flex items-center gap-1 font-medium text-blue-600 hover:text-blue-800 hover:underline transition-colors"
                                    target="_blank" rel="noopener noreferrer">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                    +62 857-4802-3239
                                </a>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-700">Rangga’25</span>
                                <a href="https://wa.me/+62881033633600"
                                    class="inline-flex items-center gap-1 font-medium text-blue-600 hover:text-blue-800 hover:underline transition-colors"
                                    target="_blank" rel="noopener noreferrer">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                    +62 881-0336-33600
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection