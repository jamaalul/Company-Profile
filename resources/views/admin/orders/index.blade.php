@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Pesanan</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola semua pesanan dari marketplace</p>
        </div>
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

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['all'] }}</p>
            <p class="text-sm text-gray-600">Total Pesanan</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $statusCounts['pending_confirmation'] }}</p>
            <p class="text-sm text-gray-600">Menunggu Konfirmasi</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-center">
            <p class="text-2xl font-bold text-green-600">{{ $statusCounts['confirmed'] }}</p>
            <p class="text-sm text-gray-600">Dikonfirmasi</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-center">
            <p class="text-2xl font-bold text-blue-600">{{ $statusCounts['paid'] }}</p>
            <p class="text-sm text-gray-600">Lunas</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-center">
            <p class="text-2xl font-bold text-red-600">{{ $statusCounts['rejected'] }}</p>
            <p class="text-sm text-gray-600">Ditolak</p>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow mb-8 p-6">
    <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari berdasarkan nomor pesanan atau nama customer..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="pending_confirmation" {{ request('status') === 'pending_confirmation' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
            Filter
        </button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                Reset
            </a>
        @endif
    </form>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                                <div class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                                <div class="text-sm text-gray-500">Angkatan: {{ $order->angkatan }}</div>
                                <div class="text-sm text-gray-500">{{ $order->bidang }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @foreach($order->items as $item)
                                <div class="text-sm">
                                    <span class="font-medium text-gray-900">{{ $item->product->name }}</span>
                                    <br>
                                    <span class="text-gray-500">{{ $item->quantity }}x - Size: {{ $order->size }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <div class="text-gray-900">Pembayaran: {{ strtoupper($order->payment_method) }}</div>
                                @if($order->no_bundling)
                                    <div class="text-gray-500">Bundling: {{ $order->no_bundling }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge['class'] }}">
                                {{ $order->status_badge['text'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="text-blue-600 hover:text-blue-900">Detail</a>
                                
                                @if($order->canBeConfirmed())
                                    <form method="POST" action="{{ route('admin.orders.confirm', $order) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-900"
                                                onclick="return confirm('Konfirmasi pesanan ini?')">
                                            Konfirmasi
                                        </button>
                                    </form>
                                @endif
                                
                                @if($order->canBeRejected())
                                    <button type="button" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="openRejectModal('{{ $order->id }}')">
                                        Tolak
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $orders->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pesanan</h3>
            <p class="mt-1 text-sm text-gray-500">Belum ada pesanan yang masuk.</p>
        </div>
    @endif
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Tolak Pesanan</h3>
                <button type="button" onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                
                <input type="hidden" name="status" value="rejected">
                
                <div class="mb-4">
                    <label for="reject_reason" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="reject_reason" 
                              name="admin_notes" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Masukkan alasan penolakan pesanan..."
                              required></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeRejectModal()"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Tolak Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRejectModal(orderId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/admin/orders/${orderId}/update-status`;
    modal.classList.remove('hidden');
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    const textarea = document.getElementById('reject_reason');
    modal.classList.add('hidden');
    textarea.value = '';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRejectModal();
    }
});
</script>
@endsection