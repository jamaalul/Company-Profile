@extends('layouts.app')

@section('title', 'Form Pembelian - ' . $product->name)

@section('content')
<section class="bg-gray-50 min-h-screen py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Product Info Header -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : '/placeholder.svg?height=150&width=150' }}" 
                         alt="{{ $product->name }}"
                         class="w-32 h-32 object-cover rounded-lg">
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                        <p class="text-3xl font-bold text-blue-800 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-gray-600">Stock tersedia: {{ $product->stock }} item</p>
                    </div>
                </div>
            </div>

            <!-- Purchase Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Pembelian</h2>
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('marketplace.purchase', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="customer_name" 
                                   name="customer_name" 
                                   value="{{ old('customer_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                        </div>

                        <!-- Angkatan -->
                        <div>
                            <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Angkatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="angkatan" 
                                   name="angkatan" 
                                   value="{{ old('angkatan') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Contoh: 2021, 2022, dst"
                                   required>
                        </div>

                        <!-- Bidang -->
                        <div>
                            <label for="bidang" class="block text-sm font-medium text-gray-700 mb-2">
                                Bidang <span class="text-red-500">*</span>
                            </label>
                            <select id="bidang" 
                                    name="bidang" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    required>
                                <option value="">Pilih Bidang</option>
                                <option value="HIMTI (non hima)" {{ old('bidang') == 'HIMTI (non hima)' ? 'selected' : '' }}>HIMTI (non hima)</option>
                                <option value="Alumni" {{ old('bidang') == 'Alumni' ? 'selected' : '' }}>Alumni</option>
                                <option value="Medinfo" {{ old('bidang') == 'Medinfo' ? 'selected' : '' }}>Medinfo</option>
                                <option value="Pendidikan" {{ old('bidang') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="Pengmas" {{ old('bidang') == 'Pengmas' ? 'selected' : '' }}>Pengmas</option>
                                <option value="Perhubungan" {{ old('bidang') == 'Perhubungan' ? 'selected' : '' }}>Perhubungan</option>
                                <option value="PSDM" {{ old('bidang') == 'PSDM' ? 'selected' : '' }}>PSDM</option>
                                <option value="Ekraf" {{ old('bidang') == 'Ekraf' ? 'selected' : '' }}>Ekraf</option>
                            </select>
                        </div>

                        <!-- No Telp -->
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                No. Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" 
                                   id="customer_phone" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Contoh: 08123456789"
                                   required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea id="customer_address" 
                                  name="customer_address" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  placeholder="Masukkan alamat lengkap untuk pengiriman"
                                  required>{{ old('customer_address') }}</textarea>
                    </div>

                    <!-- Size -->
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700 mb-2">
                            Size <span class="text-red-500">*</span>
                        </label>
                        <select id="size" 
                                name="size" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                required>
                            <option value="">Pilih Size</option>
                            <option value="XS" {{ old('size') == 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="3XL" {{ old('size') == '3XL' ? 'selected' : '' }}>3XL</option>
                        </select>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-4">
                            Metode Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative">
                                <input type="radio" 
                                       id="cash" 
                                       name="payment_method" 
                                       value="cash"
                                       class="peer sr-only"
                                       {{ old('payment_method') == 'cash' ? 'checked' : '' }}>
                                <label for="cash" 
                                       class="flex items-center justify-center w-full p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-green-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">Cash</span>
                                        <p class="text-sm text-gray-600">Bayar tunai</p>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="relative">
                                <input type="radio" 
                                       id="qris" 
                                       name="payment_method" 
                                       value="qris"
                                       class="peer sr-only"
                                       {{ old('payment_method') == 'qris' ? 'checked' : '' }}>
                                <label for="qris" 
                                       class="flex items-center justify-center w-full p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-blue-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">QRIS</span>
                                        <p class="text-sm text-gray-600">Scan QR Code</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Bukti Pembayaran -->
                    <div>
                        <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">
                            Bukti Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition duration-200">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="payment_proof" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload bukti pembayaran</span>
                                        <input id="payment_proof" 
                                               name="payment_proof" 
                                               type="file" 
                                               accept="image/*"
                                               class="sr-only"
                                               required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                            </div>
                        </div>
                        <div id="file-preview" class="mt-4 hidden">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span id="file-name" class="text-sm text-gray-700"></span>
                                </div>
                                <button type="button" id="remove-file" class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- QRIS Section -->
                    <div id="qris-section" class="hidden">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-blue-800 mb-4 text-center">QR Code Pembayaran</h4>
                            <div class="flex justify-center mb-4">
                                <!-- Placeholder untuk QRIS image - Anda perlu menyimpan image ini di public/images/ -->
                                <img src="{{ asset('images/qris-himti.jpg') }}" 
                                     alt="QRIS HIMTI" 
                                     class="max-w-xs w-full h-auto border rounded-lg shadow-sm"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzZiNzI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlIFFSSVMgVGlkYWsgRGl0ZW11a2FuPC90ZXh0Pjwvc3ZnPg==';">
                            </div>
                            <div class="text-center text-sm text-blue-700">
                                <p class="mb-2"><strong>Ekraf Himti</strong></p>
                                <p class="mb-2">NMID: ID1025409869357</p>
                                <p class="mb-4">Scan QR Code di atas untuk melakukan pembayaran</p>
                                <p class="text-xs text-gray-600">
                                    Setelah pembayaran berhasil, silakan upload bukti pembayaran (screenshot) di atas
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-medium text-gray-700">Total Harga:</span>
                            <span class="font-bold text-2xl text-blue-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('marketplace.show', $product) }}" 
                           class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200 text-center">
                            Kembali
                        </a>
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-blue-800 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kirim Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('payment_proof');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const removeFileBtn = document.getElementById('remove-file');
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const qrisSection = document.getElementById('qris-section');

    // Show/hide QRIS section based on payment method
    paymentMethods.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'qris') {
                qrisSection.classList.remove('hidden');
            } else {
                qrisSection.classList.add('hidden');
            }
        });
    });

    // Check initial state
    const checkedPayment = document.querySelector('input[name="payment_method"]:checked');
    if (checkedPayment && checkedPayment.value === 'qris') {
        qrisSection.classList.remove('hidden');
    }

    // File upload preview
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            filePreview.classList.remove('hidden');
        }
    });

    // Remove file
    removeFileBtn.addEventListener('click', function() {
        fileInput.value = '';
        filePreview.classList.add('hidden');
    });
});
</script>
@endsection