@extends('admin.layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan #{{ $order->order_number }}</h1>
            <p class="mt-1 text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" 
           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
            ← Kembali
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <div class="flex">
            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
        <div class="flex">
            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Customer Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Customer</h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->customer_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->customer_phone }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Angkatan</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->angkatan }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Bidang</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->bidang }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->customer_address }}</dd>
                </div>
            </dl>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Produk</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                    <img src="{{ $item->product->featured_image ? asset('storage/' . $item->product->featured_image) : '/placeholder.svg?height=80&width=80' }}" 
                        alt="{{ $item->product->name }}"
                        class="w-16 h-16 object-cover rounded-lg">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                        <p class="text-sm text-gray-600">Size: {{ $order->size }}</p>
                        <p class="text-sm text-gray-600">Jumlah: 1 item</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">per item</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Total -->
            <div class="border-t border-gray-200 pt-4 mt-6">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-900">Total Pembayaran</span>
                    <span class="text-2xl font-bold text-blue-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Metode Pembayaran</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ strtoupper($order->payment_method) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status Pembayaran</dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge['class'] }}">
                            {{ $order->status_badge['text'] }}
                        </span>
                    </dd>
                </div>
            </dl>
            
            @if($order->payment_proof)
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Bukti Pembayaran</dt>
                    <div class="border border-gray-200 rounded-lg p-4">
                        {{-- Debug info (remove in production) --}}
                        {{-- <div class="text-xs text-gray-400 mb-2 p-2 bg-gray-50 rounded">
                            <p>Database path: {{ $order->payment_proof }}</p>
                            <p>Full URL: {{ asset('storage/' . $order->payment_proof) }}</p>
                            <p>File exists: {{ Storage::disk('public')->exists($order->payment_proof) ? 'Yes' : 'No' }}</p>
                        </div> --}}
                        
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                            alt="Bukti Pembayaran"
                            class="max-w-full h-auto max-h-96 mx-auto rounded-lg cursor-pointer"
                            onclick="openImageModal('{{ asset('storage/' . $order->payment_proof) }}')"
                            onload="this.style.border='2px solid green'; console.log('Image loaded successfully');"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block'; console.log('Image failed to load');">
                        
                        {{-- Error fallback --}}
                        <div style="display:none;" class="bg-red-50 border border-red-200 rounded p-4 text-center">
                            <p class="text-red-600 text-sm">⚠️ Gambar tidak dapat dimuat</p>
                            <p class="text-xs text-gray-500 mt-1">Path: {{ $order->payment_proof }}</p>
                            <div class="mt-3 space-y-2">
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" 
                                target="_blank" 
                                class="inline-block text-blue-600 underline text-sm">
                                    Coba buka di tab baru
                                </a>
                                <br>
                                <a href="{{ url('storage/' . $order->payment_proof) }}" 
                                target="_blank" 
                                class="inline-block text-blue-600 underline text-sm">
                                    URL alternatif
                                </a>
                            </div>
                        </div>
                        
                        <p class="text-center text-sm text-gray-500 mt-2">Klik untuk memperbesar</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Panel -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Pesanan</h3>
            
            <!-- Status Update Form -->
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                    <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending_confirmation" {{ $order->status === 'pending_confirmation' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Lunas</option>
                        <option value="rejected" {{ $order->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                
                <div>
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                    <textarea id="admin_notes" 
                              name="admin_notes" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Tambahkan catatan (opsional)">{{ $order->admin_notes }}</textarea>
                </div>
                
                <button type="submit" 
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Update Status
                </button>
            </form>

            <!-- Quick Actions -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Aksi Cepat</h4>
                <div class="space-y-2">
                    @if($order->canBeConfirmed())
                        <form method="POST" action="{{ route('admin.orders.confirm', $order) }}" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    onclick="return confirm('Konfirmasi pesanan ini?')"
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                ✓ Konfirmasi Pesanan
                            </button>
                        </form>
                    @endif
                    
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', str_replace(['+', '-', ' '], '', $order->customer_phone)) }}?text=Halo {{ $order->customer_name }}, terima kasih telah berbelanja di HIMTI Store. Pesanan Anda dengan nomor {{ $order->order_number }} sedang kami proses."
                       target="_blank"
                       class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                        </svg>
                        Hubungi Customer
                    </a>
                    
                    <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Hapus pesanan ini? Aksi ini tidak dapat dibatalkan!')"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                            🗑️ Hapus Pesanan
                        </button>
                    </form>
                </div>
            </div>
            
            @if($order->admin_notes)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Catatan Admin</h4>
                    <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">{{ $order->admin_notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-lg max-w-4xl w-full">
            <div class="flex items-center justify-between p-4 border-b">
                {{-- <h3 class="text-lg font-medium text-gray-900">Bukti Pembayaran</h3>
                <button type="button" onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button> --}}
                
            </div>
            <div class="p-4">
                <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto max-h-96 object-contain mx-auto">
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageSrc;
    modal.classList.remove('hidden');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection