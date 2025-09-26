@extends('layouts.app')

@section('title', 'Pesanan Berhasil - HIMTI STORE')

@section('content')
<section class="bg-gray-50 min-h-screen py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Berhasil Dikirim!</h1>
                <p class="text-gray-600 mb-8">
                    Terima kasih telah berbelanja di HIMTI Store. Pesanan Anda sedang menunggu konfirmasi dari admin.
                </p>

                <!-- Order Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pesanan</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nomor Pesanan:</span>
                            <span class="font-medium text-gray-900">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Pemesan:</span>
                            <span class="font-medium text-gray-900">{{ $order->customer_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Angkatan:</span>
                            <span class="font-medium text-gray-900">{{ $order->angkatan }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bidang:</span>
                            <span class="font-medium text-gray-900">{{ $order->bidang }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Size:</span>
                            <span class="font-medium text-gray-900">{{ $order->size }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="font-medium text-gray-900">1 item</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran:</span>
                            <span class="font-medium text-gray-900">{{ strtoupper($order->payment_method) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="font-bold text-blue-800 text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                Menunggu Konfirmasi
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8 text-left">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3">Langkah Selanjutnya</h3>
                    <ul class="space-y-2 text-blue-700">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-blue-200 text-blue-800 text-xs flex items-center justify-center mt-0.5 mr-3">1</span>
                            Admin akan mengecek pesanan dan bukti pembayaran Anda
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-blue-200 text-blue-800 text-xs flex items-center justify-center mt-0.5 mr-3">2</span>
                            Anda akan dihubungi melalui WhatsApp untuk konfirmasi
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 rounded-full bg-blue-200 text-blue-800 text-xs flex items-center justify-center mt-0.5 mr-3">3</span>
                            Produk akan diproses dan dikirim setelah konfirmasi
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('marketplace.index') }}" 
                       class="px-6 py-3 border border-blue-800 text-blue-800 font-medium rounded-lg hover:bg-blue-50 transition duration-200">
                        Belanja Lagi
                    </a>
                    <a href="https://wa.me/6285229268809" 
                       target="_blank"
                       class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                        </svg>
                        Hubungi Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection