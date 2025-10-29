<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Keranjang & Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi (Dark Mode) --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-800/50 border border-green-600/50 text-green-300 rounded-lg shadow-lg shadow-green-900/50">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-800/50 border border-red-600/50 text-red-300 rounded-lg shadow-lg shadow-red-900/50">
                    {{ session('error') }}
                </div>
            @endif
            
            {{-- Tampilkan Error Validasi (Dark Mode) --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-800/50 border border-red-600/50 text-red-300 rounded-lg shadow-lg shadow-red-900/50">
                    <p class="font-bold">Oops! Ada beberapa kesalahan:</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card Utama (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">

                    @if ($cartItems->count() > 0)
                        <h3 class="text-2xl font-bold text-purple-100 mb-6">Ringkasan Pesanan Anda</h3>

                        {{-- Daftar Item Keranjang --}}
                        <div class="divide-y divide-purple-900/50">
                            @foreach ($cartItems as $item)
                                <div class="py-4 flex flex-col sm:flex-row items-start sm:items-center justify-between">
                                    <div class="flex items-center mb-4 sm:mb-0">
                                        <div class="w-16 h-16 bg-gray-900/50 border border-purple-800/30 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                            @if ($item->dukun->image)
                                                <img src="{{ Storage::url($item->dukun->image) }}" alt="{{ $item->dukun->nama_dukun }}" class="w-full h-full object-cover rounded-lg">
                                            @else
                                                {{-- Ikon Placeholder Dukun --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-lg font-semibold text-purple-200">{{ $item->dukun->nama_dukun }}</span>
                                            <div class="text-sm text-purple-400">{{ $item->dukun->kode_dukun }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-left sm:text-right w-full sm:w-auto">
                                        <div class="text-lg font-semibold text-purple-300">Rp {{ number_format($item->dukun->harga, 0, ',', '.') }} / Hari</div>
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST" class="mt-1" onsubmit="return confirm('Hapus item ini dari keranjang?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition duration-300">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Form Checkout (Pilih Tanggal) --}}
                        <form action="{{ route('booking.store') }}" method="POST" class="mt-8 border-t border-purple-700/50 pt-8">
                            @csrf
                            <h4 class="text-xl font-bold text-purple-200 mb-4">Pilih Tanggal Sewa</h4>
                            <p class="text-sm text-purple-300 mb-4">Semua item di keranjang akan disewa untuk rentang tanggal yang sama. Durasi sewa maksimal 5 hari.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Tanggal Mulai Sewa --}}
                                <div>
                                    <label for="start_date_input" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Tanggal Mulai Sewa') }}</label>
                                    <input id="start_date_input" type="date" name="tanggal_mulai_sewa" value="{{ old('tanggal_mulai_sewa') }}" required min="{{ now()->toDateString() }}"
                                           class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500"
                                           style="color-scheme: dark;">
                                    <x-input-error :messages="$errors->get('tanggal_mulai_sewa')" class="mt-2" />
                                </div>
                                
                                {{-- Tanggal Selesai Sewa --}}
                                <div>
                                    <label for="end_date_input" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Tanggal Selesai Sewa') }}</label>
                                    <input id="end_date_input" type="date" name="tanggal_selesai_sewa" value="{{ old('tanggal_selesai_sewa') }}" required min="{{ now()->toDateString() }}"
                                           class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500"
                                           style="color-scheme: dark;">
                                    <x-input-error :messages="$errors->get('tanggal_selesai_sewa')" class="mt-2" />
                                </div>
                            </div>
                            
                            {{-- Ringkasan Biaya --}}
                            <div class="mt-6 border-t border-purple-700/50 pt-6">
                                <div class="flex justify-between items-center text-xl font-bold text-purple-100">
                                    <span>Total Biaya Sewa:</span>
                                    <span id="total_price_display" class="text-purple-100">Rp 0</span> 
                                </div>
                                <p class="text-sm text-purple-400 mt-2">Denda akan ditagih terpisah jika pengajuan pengembalian terlambat.</p>
                            </div>

                            <div class="mt-6 text-right">
                                {{-- Tombol Checkout dengan Efek Mistis --}}
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 text-base font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                                    <span class="relative z-10">{{ __('Booking & Bayar Sekarang') }}</span>
                                    <div class="absolute inset-0 mystical-shimmer"></div>
                                </button>
                            </div>

                        </form>

                    @else
                        {{-- Keranjang Kosong --}}
                        <div class="text-center py-12 px-6">
                            <svg class="w-20 h-20 text-purple-400/30 mx-auto mb-4 animate-pulse-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <h3 class="text-xl font-semibold text-purple-200 mb-2">Keranjang Anda Kosong</h3>
                            <p class="text-purple-400/70 mb-6">Sepertinya Anda belum memilih dukun untuk disewa.</p>
                            <a href="{{ route('user.dashboard') }}"
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-purple-500/50 hover:shadow-purple-500/70 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-out group relative overflow-hidden border border-purple-400/50 animate-mystical-pulse">
                                <span class="relative z-10">Jelajahi Katalog</span>
                                <div class="absolute inset-0 mystical-shimmer"></div>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

{{-- Script JS tetap sama, hanya perlu di-push --}}
@push('scripts')
<script>
    // Pastikan skrip ini dijalankan hanya jika form-nya ada
    const startDateInput = document.getElementById('start_date_input');
    const endDateInput = document.getElementById('end_date_input');
    const totalPriceDisplay = document.getElementById('total_price_display');
    
    // Ambil subtotal
    const subtotalDailyPrice = {{ $cartItems->count() > 0 ? $cartItems->sum(fn($item) => $item->dukun->harga) : 0 }};

    function calculateTotalPrice() {
        // Pastikan elemen ada sebelum melanjutkan
        if (!startDateInput || !endDateInput || !totalPriceDisplay) {
            return;
        }
        
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;

        if (!startDateValue || !endDateValue) {
            totalPriceDisplay.textContent = 'Rp 0';
            return;
        }

        const startDate = new Date(startDateValue);
        const endDate = new Date(endDateValue);

        if (endDate < startDate) {
            totalPriceDisplay.textContent = 'Tanggal tidak valid';
            totalPriceDisplay.classList.add('text-red-400'); // Tambah style error
            return;
        }
        
        totalPriceDisplay.classList.remove('text-red-400'); // Hapus style error

        const timeDifference = endDate.getTime() - startDate.getTime();
        const durationDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) + 1;

        // Validasi maks 5 hari
        if (durationDays > 5) {
            totalPriceDisplay.textContent = 'Maksimal 5 hari';
            totalPriceDisplay.classList.add('text-red-400');
            // Mungkin nonaktifkan tombol submit di sini
            return;
        }

        const totalPrice = subtotalDailyPrice * durationDays;

        const formattedPrice = new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(totalPrice);

        totalPriceDisplay.textContent = formattedPrice;
    }

    // Tambahkan event listener hanya jika elemen ditemukan
    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', calculateTotalPrice);
        endDateInput.addEventListener('change', calculateTotalPrice);
    }

    document.addEventListener('DOMContentLoaded', calculateTotalPrice);

</script>
@endpush
</x-app-layout>