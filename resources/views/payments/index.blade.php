<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Manage Upgrade Plan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .font-opensans { font-family: 'Open Sans', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .bg-primary { background-color: #2563eb; }
        .text-primary { color: #2563eb; }
        .border-primary { border-color: #2563eb; }
        .hover-primary:hover { background-color: #1d4ed8; }
        .focus-primary:focus { 
            border-color: #2563eb; 
            ring-color: rgba(37, 99, 235, 0.2);
        }
        
        .modal {
            transition: all 0.3s ease;
        }
        
        .table-row {
            transition: all 0.2s ease;
        }
        
        .table-row:hover {
            background-color: #f8fafc;
            transform: translateX(4px);
        }
        
        .btn-action {
            transition: all 0.2s ease;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
        }
        
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .card-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .price-badge {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .btn-export {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        .btn-export:hover {
            background: linear-gradient(135deg, #059669, #047857);
        }

        .btn-back {
            background: linear-gradient(135deg, #6b7280, #4b5563);
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563, #374151);
        }
    </style>
</head>
<body class="bg-gray-50 font-poppins">
@extends('layouts.appadmin')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Main Content -->
    <div class="bg-white rounded-xl card-shadow">
        <!-- Header Actions -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 font-opensans">Data Payments</h3>
                    <p class="text-sm text-gray-600 font-poppins mt-1">Kelola semua metode pembayaran dan paket</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">                    
                    <!-- Export CSV Button -->
                    <button onclick="exportToCSV()" 
                            class="btn-export text-white px-6 py-2 rounded-lg font-semibold font-poppins btn-action flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Export CSV</span>
                    </button>
                    
                    <!-- Add Payment Button -->
                    <button onclick="openModal()" class="bg-primary hover-primary text-white px-6 py-2 rounded-lg font-semibold font-poppins btn-action flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Tambah Payment</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full" id="paymentsTable">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-50" 
                        data-id="{{ $payment->id }}" 
                        data-payment-method="{{ $payment->payment_method }}" 
                        data-package="{{ $payment->package }}" 
                        data-description="{{ $payment->description ?? '-' }}" 
                        data-price="{{ $payment->price }}" 
                        data-created="{{ $payment->created_at->format('d M Y, H:i') }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $payment->payment_method }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $payment->package == 'Genius' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                Paket {{ $payment->package }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $payment->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            Rp {{ number_format($payment->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $payment->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <!-- Edit Button -->
                                <button onclick="editPayment({{ $payment->id }}, '{{ $payment->payment_method }}', '{{ $payment->package }}', '{{ addslashes($payment->description ?? '') }}', {{ $payment->price }})" 
                                        class="text-indigo-600 hover:text-indigo-900 btn-action">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('payments.destroy', $payment) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus payment ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 btn-action">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data payments</h3>
                                <p class="text-gray-500 mb-4">Mulai dengan menambahkan payment method dan package pertama Anda.</p>
                                <button onclick="openModal()" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                    Tambah Payment
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if($payments->hasPages())
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                @if($payments->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                        Previous
                    </span>
                @else
                    <a href="{{ $payments->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </a>
                @endif
                @if($payments->hasMorePages())
                    <a href="{{ $payments->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </a>
                @else
                    <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Menampilkan {{ $payments->firstItem() ?? 0 }} - {{ $payments->lastItem() ?? 0 }} dari {{ $payments->total() }} data
                    </p>
                </div>
                <div>
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="bg-white px-4 py-3 border-t border-gray-200">
            <p class="text-sm text-gray-700">
                Menampilkan {{ $payments->count() }} dari {{ $payments->total() }} data
            </p>
        </div>
        @endif
    </div>
</div>

<!-- Modal Form -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl w-full max-w-md modal animate-fade-in">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-900 font-opensans">Tambah Payment</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <form id="paymentForm" method="POST" class="px-6 py-4 space-y-4">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="">
                <input type="hidden" id="paymentId" name="id">
                
                <div>
                    <label for="package" class="block text-sm font-semibold text-gray-700 font-poppins mb-2">Package *</label>
                    <select id="package" name="package" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-poppins">
                        <option value="">Pilih Package</option>
                        <option value="Genius">Paket Genius</option>
                        <option value="Professor">Paket Professor</option>
                    </select>
                </div>
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 font-poppins mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-poppins resize-none"
                              placeholder="Deskripsi optional untuk payment ini..."></textarea>
                </div>
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 font-poppins mb-2">Price (Rupiah) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500 font-poppins">Rp</span>
                        <input type="number" id="price" name="price" required min="0" 
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-poppins"
                               placeholder="0">
                    </div>
                </div>
                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal()" 
                            class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 font-poppins">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-primary hover-primary text-white px-4 py-3 rounded-lg font-semibold font-poppins btn-action">
                        <span id="submitButtonText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    let currentEditId = null;
    let isEditMode = false;
    // Export to CSV function - reads actual data from the table
    function exportToCSV() {
        const headers = ['ID', 'Payment Method', 'Package', 'Description', 'Price', 'Created At'];
        
        let csvContent = headers.join(',') + '\n';
        
        // Get actual data from the table rows
        const tableRows = document.querySelectorAll('#paymentsTable tbody tr[data-id]');
        
        if (tableRows.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada Data',
                text: 'Tidak ada data payments untuk diekspor',
                showConfirmButton: true
            });
            return;
        }
        
        tableRows.forEach(row => {
            const id = row.getAttribute('data-id');
            const paymentMethod = row.getAttribute('data-payment-method');
            const package = row.getAttribute('data-package');
            const description = row.getAttribute('data-description');
            const price = row.getAttribute('data-price');
            const created = row.getAttribute('data-created');
            
            // Escape quotes and handle commas in CSV
            const csvRow = [
                id,
                `"${paymentMethod}"`,
                `"Paket ${package}"`,
                `"${description}"`,
                price,
                `"${created}"`
            ];
            
            csvContent += csvRow.join(',') + '\n';
        });
        
        // Create and download file
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', `payments_export_${new Date().toISOString().slice(0, 10)}.csv`);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Show success message
        Swal.fire({
            icon: 'success',
            title: 'Export Berhasil!',
            text: `${tableRows.length} data payments berhasil diekspor ke CSV`,
            showConfirmButton: false,
            timer: 2000
        });
    }
    function openModal() {
        currentEditId = null;
        isEditMode = false;
        document.getElementById('modalTitle').textContent = 'Tambah Payment';
        document.getElementById('submitButtonText').textContent = 'Simpan';
        document.getElementById('paymentForm').reset();
        document.getElementById('paymentId').value = '';
        document.getElementById('methodField').value = '';
        document.getElementById('paymentForm').action = '{{ route("payments.store") }}';
        document.getElementById('modal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
    function editPayment(id, paymentMethod, package, description, price) {
        currentEditId = id;
        isEditMode = true;
        document.getElementById('modalTitle').textContent = 'Edit Payment';
        document.getElementById('submitButtonText').textContent = 'Update';
        document.getElementById('paymentId').value = id;
        document.getElementById('paymentMethod').value = paymentMethod;
        document.getElementById('package').value = package;
        document.getElementById('description').value = description;
        document.getElementById('price').value = price;
            
        // Set form action and method for update
        document.getElementById('methodField').value = 'PUT';
        // PERBAIKAN: Ganti dari /payments/ ke /payment/ (sesuai route Anda)
        document.getElementById('paymentForm').action = `/payment/${id}`;
            
        document.getElementById('modal').classList.remove('hidden');
    }
    // Handle form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        // Let the form submit normally to Laravel backend
        // Show loading state
        const submitBtn = document.getElementById('submitButtonText');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Menyimpan...';
        
        // Re-enable button after a short delay if form doesn't redirect
        setTimeout(() => {
            submitBtn.textContent = originalText;
        }, 3000);
    });
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Escape to close modal
        if (e.key === 'Escape' && !document.getElementById('modal').classList.contains('hidden')) {
            closeModal();
        }
        
        // Ctrl+N to add new payment  
        if (e.ctrlKey && e.key === 'n') {
            e.preventDefault();
            openModal();
        }
        
        // Ctrl+E to export
        if (e.ctrlKey && e.key === 'e') {
            e.preventDefault();
            exportToCSV();
        }
    });
    // Real-time price formatting
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            const formatted = parseInt(value).toLocaleString('id-ID');
            e.target.setAttribute('data-formatted', formatted);
        }
    });
    // Initialize tooltips or other UI enhancements
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Payments management system loaded');
    });
</script>
</body>
</html>