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
                        @if($order->payment_type === 'down_payment')
                            <div class="flex justify-between items-center pb-3 border-gray-200 border-b border-dashed">
                                <span class="text-gray-500">Total Harga</span>
                                <span class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-gray-200 border-b border-dashed">
                                <span class="text-gray-500">Uang Muka (Dibayar)</span>
                                <span class="font-medium text-emerald-600">Rp {{ number_format($order->amount_paid, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <span class="font-bold text-gray-700 text-xs uppercase tracking-wider">Sisa Pembayaran</span>
                                <span class="font-bold text-blue-700 text-lg">Rp {{ number_format($order->remaining_balance, 0, ',', '.') }}</span>
                            </div>
                        @else
                            <div class="flex justify-between items-center pt-2">
                                <span class="font-bold text-gray-700 text-xs uppercase tracking-wider">Total Pembayaran</span>
                                <span class="font-bold text-blue-700 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    @if($order->status === \App\Enums\OrderStatus::PendingFinalPayment && $order->payment_type === 'down_payment')
                        <div class="mt-6 pt-6 border-t border-gray-200 border-dashed">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="flex justify-center items-center bg-gray-900 rounded-full w-6 h-6 font-bold text-white text-xs">!</span>
                                <h3 class="font-bold text-gray-500 text-xs md:text-sm uppercase tracking-widest">Pelunasan via QRIS</h3>
                            </div>
                            
                            @if(session('success'))
                                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 text-sm rounded-lg border border-emerald-200">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="flex items-start gap-3 bg-red-50 mb-6 p-4 border-red-500 border-l-4 rounded-r-lg">
                                    <svg class="mt-0.5 w-5 h-5 text-red-500 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-bold text-red-800 text-sm">Oops!</p>
                                        <p class="mt-1 text-red-700 text-sm">{{ session('error') }}</p>
                                    </div>
                                </div>
                            @endif
                            @error('final_payment_proof')
                                <div class="flex items-start gap-3 bg-red-50 mb-6 p-4 border-red-500 border-l-4 rounded-r-lg">
                                    <svg class="mt-0.5 w-5 h-5 text-red-500 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-bold text-red-800 text-sm">Terdapat Kesalahan</p>
                                        <p class="mt-1 text-red-700 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror

                            {{-- QRIS block --}}
                            <div class="flex flex-col gap-6 py-6 border-gray-200 border-y border-dashed mb-6">
                                <div class="bg-gray-50 border border-gray-200 h-auto shrink-0 w-full flex justify-center py-4 rounded-lg">
                                    <img src="{{ asset('assets/qris.png') }}" alt="QRIS Himti" class="w-48 object-center object-contain">
                                </div>
                                <div class="flex-1 w-full text-center">
                                    <h4 class="mb-4 font-bold text-gray-900 text-sm uppercase tracking-widest">
                                        Ekraf Himti</h4>
                                    <div class="space-y-3 mb-6">
                                        <div class="flex justify-center text-sm">
                                            <span class="mt-0.5 w-20 font-medium text-gray-500 text-xs uppercase tracking-widest">NMID</span>
                                            <span class="font-bold text-gray-900">ID1025409869357</span>
                                        </div>
                                        <div class="flex justify-center text-sm">
                                            <span class="mt-0.5 w-20 font-medium text-gray-500 text-xs uppercase tracking-widest">Metode</span>
                                            <span class="font-bold text-gray-900">QRIS — Semua e-wallet & M-Banking</span>
                                        </div>
                                    </div>
                                    <div class="inline-block bg-yellow-50 p-3 border-yellow-400 border-l-4 rounded-r text-yellow-800 text-sm text-left">
                                        Scan QR Code dengan aplikasi dompet digital atau M-Banking Anda, lalu upload screenshot bukti pelunasan di bawah ini.
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('marketplace.order.final-payment', $order->tracking_token) }}" method="POST" enctype="multipart/form-data" id="payment-form">
                                @csrf
                                {{-- Upload Bukti Pembayaran --}}
                                <div>
                                    <label class="block mb-2 font-semibold text-gray-700 text-sm">Upload Bukti Pelunasan <span class="text-red-500">*</span></label>

                                    <div class="group relative bg-gray-50 p-6 border-2 border-gray-300 hover:border-blue-500 border-dashed rounded-xl text-center transition-colors cursor-pointer"
                                        id="upload-zone">
                                        <svg class="mx-auto mb-3 w-8 h-8 text-gray-400 group-hover:text-blue-500 transition-colors"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                        </svg>
                                        <div class="text-gray-600 text-sm"><strong class="text-blue-700">Pilih file</strong> atau drag &amp; drop di sini</div>
                                        <div class="mt-2 text-gray-500 text-xs">PNG, JPG, JPEG — Maks. 5 MB</div>
                                        <input id="final_payment_proof" name="final_payment_proof" type="file" accept="image/jpeg,image/png,image/jpg"
                                            class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" required>
                                    </div>

                                    <div class="flex justify-between items-center bg-green-50 mt-4 p-4 border border-green-200 rounded-xl"
                                        id="file-preview" style="display:none;">
                                        <div class="flex items-center gap-3 overflow-hidden">
                                            <svg class="w-6 h-6 text-green-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium text-gray-900 text-sm truncate"
                                                id="file-name"></span>
                                        </div>
                                        <button type="button"
                                            class="bg-white hover:bg-red-50 p-1.5 rounded-md focus:outline-none text-gray-400 hover:text-red-500 transition-colors shrink-0"
                                            id="remove-file" aria-label="Hapus file">
                                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" id="submit-btn" class="mt-6 flex w-full justify-center items-center gap-2 bg-blue-700 hover:bg-blue-600 disabled:opacity-50 px-8 py-3.5 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold text-white transition-colors disabled:cursor-not-allowed text-sm">
                                    <svg id="submit-spinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                    </svg>
                                    <span id="submit-text">Kirim Bukti Pelunasan</span>
                                </button>
                            </form>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const form = document.getElementById('payment-form');
                                const submitBtn = document.getElementById('submit-btn');
                                const submitSpinner = document.getElementById('submit-spinner');
                                const submitText = document.getElementById('submit-text');

                                if(form) {
                                    form.addEventListener('submit', function (e) {
                                        setTimeout(() => {
                                            submitBtn.disabled = true;
                                            submitSpinner.classList.remove('hidden');
                                            submitText.textContent = 'Memproses...';
                                        }, 10);
                                    });
                                }

                                const fileInput = document.getElementById('final_payment_proof');
                                const filePreview = document.getElementById('file-preview');
                                const fileName = document.getElementById('file-name');
                                const removeBtn = document.getElementById('remove-file');
                                const uploadZone = document.getElementById('upload-zone');

                                if(fileInput) {
                                    fileInput.addEventListener('change', function (e) {
                                        const file = e.target.files[0];
                                        if (file) {
                                            fileName.textContent = file.name;
                                            filePreview.style.display = 'flex';

                                            // Tailwind dynamic classes for active state
                                            uploadZone.classList.remove('border-gray-300', 'bg-gray-50');
                                            uploadZone.classList.add('border-green-500', 'bg-green-50');
                                        }
                                    });
                                }

                                if(removeBtn) {
                                    removeBtn.addEventListener('click', function () {
                                        fileInput.value = '';
                                        filePreview.style.display = 'none';

                                        // Revert Tailwind classes
                                        uploadZone.classList.remove('border-green-500', 'bg-green-50');
                                        uploadZone.classList.add('border-gray-300', 'bg-gray-50');
                                    });
                                }

                                if(uploadZone) {
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
                                }
                            });
                        </script>
                    @endif
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