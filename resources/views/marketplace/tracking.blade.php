@extends('layouts.app-plain')

@section('title', 'Lacak Pesanan - HIMTI STORE')

@section('content')
    <section class="bg-gray-50 py-16 min-h-screen">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 container">
            <div class="mx-auto max-w-3xl">
                <div class="bg-white shadow-lg p-8 rounded-lg">
                    <h1 class="mb-6 font-bold text-gray-800 text-3xl text-center">Status Pesanan</h1>

                    <div class="mb-6 pb-6 border-gray-200 border-b">
                        <div class="flex sm:flex-row flex-col justify-between items-center mb-4">
                            <span class="font-medium text-gray-600">Nomor Pesanan</span>
                            <span class="font-bold text-blue-800 text-xl">{{ $order->order_number }}</span>
                        </div>

                        <div class="flex sm:flex-row flex-col justify-between items-center">
                            <span class="font-medium text-gray-600">Status Saat Ini</span>
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-{{ $order->status->color() }}-100 text-{{ $order->status->color() }}-800 mt-2 sm:mt-0">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="mb-4 font-semibold text-gray-800 text-xl">Informasi Pemesan</h3>
                        <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                            <div>
                                <p class="text-gray-500 text-sm">Nama Lengkap</p>
                                <p class="font-medium">{{ $order->buyer_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">WhatsApp</p>
                                <p class="font-medium">{{ $order->buyer_whatsapp }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Pembayaran</p>
                                <p class="font-medium text-blue-700 text-lg">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4 font-semibold text-gray-800 text-xl">Item Pesanan</h3>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center bg-gray-50 p-4 border border-gray-200 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-gray-200 rounded-md w-16 h-16 overflow-hidden">
                                            @if($item->product && $item->product->image_path)
                                                <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="flex justify-center items-center w-full h-full text-gray-400">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $item->getItemName() }}</h4>
                                            <p class="text-gray-600 text-sm">Jumlah: {{ $item->quantity }}</p>
                                            @foreach($item->fieldValues as $field)
                                                <p class="text-gray-500 text-xs">{{ $field->productField->label }}:
                                                    {{ $field->value ?? 'File Terlampir' }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="font-medium text-gray-900">
                                        Rp {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection