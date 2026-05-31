@extends('layouts.app-plain')

@section('title', 'Form Pembelian - ' . $bundle->name)

@section('content')
    <section class="bg-gray-50 py-16 min-h-screen">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl container">

            {{-- Breadcrumb --}}
            <nav class="flex mb-8 text-gray-500 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('marketplace.index') }}"
                            class="hover:text-blue-600 transition-colors">Marketplace</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="mx-1 w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('marketplace.bundle.show', $bundle->id) }}"
                                class="hover:text-blue-600 transition-colors">{{ Str::limit($bundle->name, 30) }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="mx-1 w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 font-medium text-gray-700">Checkout Bundle</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="mb-2 font-bold text-gray-900 text-3xl md:text-4xl">Konfirmasi Pesanan</h1>
                <p class="text-gray-600">Isi data dengan benar. Pesanan akan diproses setelah pembayaran dikonfirmasi.</p>
            </div>

            <div class="bg-white shadow-sm p-6 md:p-8 border border-gray-100 rounded-2xl">
                {{-- Product strip --}}
                <div class="flex sm:flex-row flex-col sm:items-center gap-4 mb-8 pb-6 border-gray-100 border-b">
                    <div class="bg-gray-100 rounded-lg w-24 h-24 overflow-hidden shrink-0">
                        @if($bundle->image_path)
                            <img src="{{ asset('storage/' . $bundle->image_path) }}" alt="{{ $bundle->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="/placeholder.svg?height=96&width=96" alt="{{ $bundle->name }}"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <h2 class="mb-1 font-bold text-gray-900 text-lg md:text-xl line-clamp-2">{{ $bundle->name }} <span
                                class="bg-blue-100 px-2 py-0.5 rounded text-blue-800 text-xs align-middle">Bundle</span>
                        </h2>
                        <p class="mb-2 text-gray-500 text-sm">Berisi: {{ $bundle->products->count() }} tipe produk</p>
                    </div>
                    <div class="sm:text-right shrink-0">
                        <p class="font-bold text-blue-800 text-xl md:text-2xl">Rp
                            {{ number_format($bundle->special_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- Alerts --}}
                @if(session('error'))
                    <div class="flex items-start gap-3 bg-red-50 mb-6 p-4 border-red-500 border-l-4 rounded-r-lg">
                        <svg class="mt-0.5 w-5 h-5 text-red-500 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-bold text-red-800 text-sm">Oops!</p>
                            <p class="mt-1 text-red-700 text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="flex items-start gap-3 bg-red-50 mb-6 p-4 border-red-500 border-l-4 rounded-r-lg">
                        <svg class="mt-0.5 w-5 h-5 text-red-500 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-bold text-red-800 text-sm">Terdapat Kesalahan</p>
                            <ul class="space-y-1 mt-1 text-red-700 text-sm list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('marketplace.bundle.purchase') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                    <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
                    <input type="hidden" name="quantity" value="1" id="quantity-input">
                    <input type="hidden" name="payment_method" value="qris">

                    {{-- Section 1: Informasi Pembeli --}}
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex justify-center items-center bg-gray-900 rounded-full w-6 h-6 font-bold text-white text-xs">1</span>
                            <h3 class="font-bold text-gray-500 text-xs md:text-sm uppercase tracking-widest">Informasi
                                Pembeli</h3>
                        </div>

                        <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                            <div class="col-span-1 md:col-span-2">
                                <label for="customer_name" class="block mb-2 font-semibold text-gray-700 text-sm">Nama
                                    Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name') }}"
                                    class="bg-gray-50 focus:bg-white focus:ring-opacity-50 px-4 py-3 border border-gray-300 focus:border-blue-500 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-900 transition-colors"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div>
                                <label for="customer_email" class="block mb-2 font-semibold text-gray-700 text-sm">Alamat
                                    Email <span class="text-red-500">*</span></label>
                                <input type="email" id="customer_email" name="customer_email"
                                    value="{{ old('customer_email') }}"
                                    class="bg-gray-50 focus:bg-white focus:ring-opacity-50 px-4 py-3 border border-gray-300 focus:border-blue-500 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-900 transition-colors"
                                    placeholder="nama@email.com" required>
                            </div>
                            <div>
                                <label for="customer_phone" class="block mb-2 font-semibold text-gray-700 text-sm">No.
                                    Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="tel" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}"
                                    class="bg-gray-50 focus:bg-white focus:ring-opacity-50 px-4 py-3 border border-gray-300 focus:border-blue-500 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-900 transition-colors"
                                    placeholder="08123456789" required>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Informasi Tambahan per Produk --}}
                    @php
                        $hasFields = false;
                        foreach ($bundle->products as $product) {
                            if ($product->fields->count() > 0) {
                                $hasFields = true;
                                break;
                            }
                        }
                    @endphp

                    @if($hasFields)
                        <hr class="border-gray-100">

                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <span
                                    class="flex justify-center items-center bg-gray-900 rounded-full w-6 h-6 font-bold text-white text-xs">2</span>
                                <h3 class="font-bold text-gray-500 text-xs md:text-sm uppercase tracking-widest">Informasi
                                    Tambahan (Bundle)</h3>
                            </div>

                            <div class="space-y-6">
                                @foreach($bundle->products as $product)
                                    @if($product->fields->count() > 0)
                                        @for($copy = 0; $copy < $product->pivot->quantity; $copy++)
                                            <div class="bg-gray-50 p-6 border border-gray-200 rounded-xl">
                                                <h4 class="mb-4 pb-3 border-gray-200 border-b font-bold text-gray-700 text-sm">
                                                    {{ $product->name }}
                                                    @if($product->pivot->quantity > 1)
                                                        <span class="bg-blue-100 ml-2 px-2 py-0.5 rounded font-semibold text-blue-800 text-xs">#{{ $copy + 1 }} dari {{ $product->pivot->quantity }}</span>
                                                    @endif
                                                </h4>
                                                <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                                                    @foreach($product->fields as $field)
                                                        @php $fieldName = 'fields[' . $product->id . '][' . $copy . '][' . $field->id . ']'; @endphp
                                                        <div class="{{ $field->field_type === 'file' ? 'col-span-1 md:col-span-2' : '' }}">
                                                            <label class="block mb-2 font-semibold text-gray-700 text-sm">
                                                                {{ $field->label }}
                                                                @if($field->is_required)<span class="text-red-500">*</span>@endif
                                                            </label>

                                                            @if($field->field_type === 'text')
                                                                <input type="text" name="{{ $fieldName }}"
                                                                    value="{{ old('fields.' . $product->id . '.' . $copy . '.' . $field->id) }}"
                                                                    class="bg-white focus:ring-opacity-50 px-4 py-3 border border-gray-300 focus:border-blue-500 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-900 transition-colors"
                                                                    {{ $field->is_required ? 'required' : '' }}>

                                                            @elseif($field->field_type === 'dropdown')
                                                                <select name="{{ $fieldName }}"
                                                                    style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 1rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em;"
                                                                    class="bg-white focus:ring-opacity-50 px-4 py-3 pr-10 border border-gray-300 focus:border-blue-500 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 w-full text-gray-900 transition-colors appearance-none"
                                                                    {{ $field->is_required ? 'required' : '' }}>
                                                                    <option value="">Pilih opsi...</option>
                                                                    @foreach($field->dropdown_options ?? [] as $option)
                                                                        <option value="{{ $option }}" {{ old('fields.' . $product->id . '.' . $copy . '.' . $field->id) === $option ? 'selected' : '' }}>{{ $option }}</option>
                                                                    @endforeach
                                                                </select>

                                                            @elseif($field->field_type === 'file')
                                                                <input type="file" name="{{ $fieldName }}" accept="image/*"
                                                                    class="bg-white hover:file:bg-blue-100 file:bg-blue-50 focus:ring-opacity-50 file:mr-4 file:px-4 file:py-3 border border-gray-300 focus:border-blue-500 file:border-0 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 w-full file:font-semibold text-gray-900 file:text-blue-700 file:text-sm transition-colors file:cursor-pointer"
                                                                    {{ $field->is_required ? 'required' : '' }}>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Section 3: Pembayaran --}}
                    <hr class="border-gray-100">

                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span
                                class="flex justify-center items-center bg-gray-900 rounded-full w-6 h-6 font-bold text-white text-xs">{{ $hasFields ? '3' : '2' }}</span>
                            <h3 class="font-bold text-gray-500 text-xs md:text-sm uppercase tracking-widest">Pembayaran via
                                QRIS</h3>
                        </div>

                        {{-- QRIS block --}}
                        <div
                            class="flex md:flex-row flex-col items-center md:items-start gap-6 md:gap-8 py-6 border-gray-200 border-y border-dashed">
                            <div class="bg-white border border-gray-200 h-auto shrink-0">
                                <img src="{{ asset('assets/qris.png') }}" alt="QRIS Himti"
                                    class="w-64 object-center object-contain">
                            </div>
                            <div class="flex-1 w-full md:text-left text-center">
                                <h4 class="mb-4 font-bold text-gray-900 text-sm md:text-base uppercase tracking-widest">
                                    Ekraf Himti</h4>
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-center md:justify-start text-sm">
                                        <span
                                            class="mt-0.5 w-20 font-medium text-gray-500 text-xs uppercase tracking-widest">NMID</span>
                                        <span class="font-bold text-gray-900">ID1025409869357</span>
                                    </div>
                                    <div class="flex justify-center md:justify-start text-sm">
                                        <span
                                            class="mt-0.5 w-20 font-medium text-gray-500 text-xs uppercase tracking-widest">Metode</span>
                                        <span class="font-bold text-gray-900">QRIS — Semua e-wallet & M-Banking</span>
                                    </div>
                                </div>
                                <div
                                    class="inline-block bg-yellow-50 p-3 border-yellow-400 border-l-4 rounded-r text-yellow-800 text-sm text-left">
                                    Scan QR Code dengan aplikasi dompet digital atau M-Banking Anda, lalu upload screenshot
                                    bukti pembayaran di bawah ini.
                                </div>
                            </div>
                        </div>

                        {{-- Upload Bukti Pembayaran --}}
                        <div class="mt-8">
                            <label class="block mb-2 font-semibold text-gray-700 text-sm">Bukti Pembayaran <span
                                    class="text-red-500">*</span></label>

                            <div class="group relative bg-white p-8 md:p-12 border-2 border-gray-300 hover:border-blue-500 border-dashed rounded-xl text-center transition-colors cursor-pointer"
                                id="upload-zone">
                                <svg class="mx-auto mb-3 w-10 h-10 text-gray-400 group-hover:text-blue-500 transition-colors"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <div class="text-gray-600 text-sm"><strong class="text-blue-700">Pilih file</strong> atau
                                    drag &amp; drop di sini</div>
                                <div class="mt-2 text-gray-500 text-xs">PNG, JPG, JPEG — Maks. 5 MB</div>
                                <input id="payment_proof" name="payment_proof" type="file" accept="image/*"
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" required>
                            </div>

                            <div class="flex justify-between items-center bg-green-50 mt-4 p-4 border border-green-200 rounded-xl"
                                id="file-preview" style="display:none;">
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="max-w-xs md:max-w-md font-medium text-gray-900 text-sm truncate"
                                        id="file-name"></span>
                                </div>
                                <button type="button"
                                    class="bg-white hover:bg-red-50 p-1.5 rounded-md focus:outline-none text-gray-400 hover:text-red-500 transition-colors"
                                    id="remove-file" aria-label="Hapus file">
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Order summary --}}
                    <div class="mt-10 pt-6 border-gray-200 border-t-2">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-bold text-gray-500 text-xs md:text-sm uppercase tracking-widest">Total
                                    Pembayaran</div>
                                <div class="mt-1 font-medium text-gray-500 text-sm">1 Bundle &times; Rp
                                    {{ number_format($bundle->special_price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="font-bold text-gray-900 text-2xl md:text-4xl tracking-tight"
                                id="total-price-display">
                                Rp {{ number_format($bundle->special_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex md:flex-row flex-col gap-4 mt-8 pt-4">
                        <a href="{{ route('marketplace.show', $product->id) }}"
                            class="flex justify-center items-center bg-white hover:bg-gray-50 px-8 py-3.5 border border-gray-200 rounded-xl font-semibold text-gray-700 text-center transition-colors">
                            Kembali
                        </a>
                        <button type="submit"
                            class="flex flex-1 justify-center items-center gap-2 bg-blue-700 hover:bg-blue-500 px-8 py-3.5 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold text-white transition-colors">
                            Buat Pesanan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('payment_proof');
            const filePreview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const removeBtn = document.getElementById('remove-file');
            const uploadZone = document.getElementById('upload-zone');

            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    fileName.textContent = file.name;
                    filePreview.style.display = 'flex';

                    // Tailwind dynamic classes for active state
                    uploadZone.classList.remove('border-gray-300', 'bg-white');
                    uploadZone.classList.add('border-green-500', 'bg-green-50');
                }
            });

            removeBtn.addEventListener('click', function () {
                fileInput.value = '';
                filePreview.style.display = 'none';

                // Revert Tailwind classes
                uploadZone.classList.remove('border-green-500', 'bg-green-50');
                uploadZone.classList.add('border-gray-300', 'bg-white');
            });

            // Drag-and-drop visual feedback
            uploadZone.addEventListener('dragover', () => {
                uploadZone.classList.add('border-blue-500', 'bg-blue-50');
            });
            uploadZone.addEventListener('dragleave', () => {
                uploadZone.classList.remove('border-blue-500', 'bg-blue-50');
            });
            uploadZone.addEventListener('drop', () => {
                uploadZone.classList.remove('border-blue-500', 'bg-blue-50');
            });
        });
    </script>
@endsection