@extends('layouts.app-plain')

@section('title', 'Pesanan Berhasil - HIMTI STORE')

@section('content')
<section class="bg-gray-50 py-16 min-h-screen">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 container">
        <div class="mx-auto max-w-2xl">
            <div class="bg-white shadow-lg p-8 rounded-lg text-center">
                <!-- Success Icon -->
                <div class="flex justify-center items-center bg-green-100 mx-auto mb-6 rounded-full w-20 h-20">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h1 class="mb-4 font-bold text-gray-800 text-3xl">Pesanan Berhasil Dikirim!</h1>
                <p class="mb-8 text-gray-600">
                    Terima kasih telah berbelanja di HIMTI Store. Pesanan Anda sedang diproses. Simpan nomor pesanan dan link pelacakan Anda.
                </p>

                <!-- Order Details -->
                <div class="bg-gray-50 mb-8 p-6 rounded-lg text-left">
                    <h3 class="mb-4 font-semibold text-gray-800 text-lg">Detail Pesanan</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nomor Pesanan:</span>
                            <span class="font-medium text-gray-900">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Pemesan:</span>
                            <span class="font-medium text-gray-900">{{ $order->buyer_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="font-bold text-blue-800 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $order->status->color() }}-100 text-{{ $order->status->color() }}-800">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 mb-8 p-6 rounded-lg text-left">
                    <h3 class="mb-3 font-semibold text-blue-800 text-lg">Langkah Selanjutnya</h3>
                    <ul class="space-y-2 text-blue-700">
                        <li class="flex items-start">
                            <span class="flex flex-shrink-0 justify-center items-center bg-blue-200 mt-0.5 mr-3 rounded-full w-5 h-5 text-blue-800 text-xs">1</span>
                            Admin akan mengecek pesanan dan bukti pembayaran Anda
                        </li>
                        <li class="flex items-start">
                            <span class="flex flex-shrink-0 justify-center items-center bg-blue-200 mt-0.5 mr-3 rounded-full w-5 h-5 text-blue-800 text-xs">2</span>
                            Anda dapat melacak status pesanan melalui link di bawah ini
                        </li>
                        <li class="flex items-start">
                            <span class="flex flex-shrink-0 justify-center items-center bg-blue-200 mt-0.5 mr-3 rounded-full w-5 h-5 text-blue-800 text-xs">3</span>
                            Produk akan diproses dan dikirim/diambil setelah disetujui
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex sm:flex-row flex-col justify-center gap-4">
                    <a href="{{ route('marketplace.track', $order->tracking_token) }}" 
                       class="bg-blue-800 hover:bg-blue-700 px-6 py-3 rounded-lg font-medium text-white transition duration-200">
                        Lacak Pesanan
                    </a>
                    <a href="{{ route('marketplace.index') }}" 
                       class="hover:bg-blue-50 px-6 py-3 border border-blue-800 rounded-lg font-medium text-blue-800 transition duration-200">
                        Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection