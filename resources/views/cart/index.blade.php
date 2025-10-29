<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang & Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif
            
            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                    <p class="font-bold">Oops! Ada beberapa kesalahan:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Ringkasan Pesanan Anda</h3>

                    @if ($cartItems->count() > 0)
                        {{-- Daftar Item Keranjang --}}
                        <div class="divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <div class="py-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center mr-4 flex-shrink-0">
                                            @if ($item->dukun->image)
                                                <img src="{{ Storage::url($item->dukun->image) }}" alt="{{ $item->dukun->nama_dukun }}" class="w-full h-full object-cover rounded">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-lg font-semibold">{{ $item->dukun->nama_dukun }}</span>
                                            <div class="text-sm text-gray-500">{{ $item->dukun->kode_dukun }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-right">
                                        <div class="text-lg font-semibold text-indigo-600">Rp {{ number_format($item->dukun->harga, 0, ',', '.') }} / Hari</div>
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST" class="mt-1" onsubmit="return confirm('Hapus item ini dari keranjang?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Form Checkout (Pilih Tanggal) --}}
                        <form action="{{ route('booking.store') }}" method="POST" class="mt-8 border-t pt-8">
                            @csrf
                            <h4 class="text-xl font-semibold mb-4">Pilih Tanggal Sewa</h4>
                            <p class="text-sm text-gray-600 mb-4">Semua item di keranjang akan disewa untuk rentang tanggal yang sama. Durasi sewa maksimal 5 hari.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Tanggal Mulai Sewa --}}
                                <div>
                                    <x-input-label for="tanggal_mulai_sewa" :value="__('Tanggal Mulai Sewa')" />
                                    {{-- <<< TAMBAHKAN ID: start_date_input --}}
                                    <x-text-input id="start_date_input" class="block mt-1 w-full" type="date" name="tanggal_mulai_sewa" :value="old('tanggal_mulai_sewa')" required min="{{ now()->toDateString() }}" /> 
                                    <x-input-error :messages="$errors->get('tanggal_mulai_sewa')" class="mt-2" />
                                </div>
                                
                                {{-- Tanggal Selesai Sewa --}}
                                <div>
                                    <x-input-label for="tanggal_selesai_sewa" :value="__('Tanggal Selesai Sewa')" />
                                     {{-- <<< TAMBAHKAN ID: end_date_input --}}
                                    <x-text-input id="end_date_input" class="block mt-1 w-full" type="date" name="tanggal_selesai_sewa" :value="old('tanggal_selesai_sewa')" required min="{{ now()->toDateString() }}" /> 
                                    <x-input-error :messages="$errors->get('tanggal_selesai_sewa')" class="mt-2" />
                                </div>
                            </div>
                            
                            {{-- Ringkasan Biaya --}}
                            <div class="mt-6 border-t pt-6">
                                <div class="flex justify-between items-center text-xl font-semibold">
                                    {{-- <<< TAMBAHKAN ID: total_price_display --}}
                                    <span>Total Biaya Sewa:</span>
                                    <span id="total_price_display">Rp 0</span> 
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Denda akan ditagih terpisah jika pengajuan pengembalian terlambat.</p>
                            </div>

                            <div class="mt-6 text-right">
                                <x-primary-button class="py-3 px-6 text-base">
                                    {{ __('Booking & Bayar Sekarang') }}
                                </x-primary-button>
                            </div>

                        </form>

                    @else
                        {{-- Keranjang Kosong --}}
                        {{-- ... (kode keranjang kosong Anda) ... --}}
                    @endif

                </div>
            </div>
        </div>
    </div>

{{-- ============================================= --}}
{{-- ==       SCRIPT JAVASCRIPT DIMULAI         == --}}
{{-- ============================================= --}}
@push('scripts')
<script>
    // Ambil elemen input tanggal dan display total harga
    const startDateInput = document.getElementById('start_date_input');
    const endDateInput = document.getElementById('end_date_input');
    const totalPriceDisplay = document.getElementById('total_price_display');
    
    // Ambil subtotal (total harga harian) dari PHP. Gunakan item pertama karena semua item punya tanggal sama.
    // Pastikan ada item di keranjang sebelum mengakses properti
    const subtotalDailyPrice = {{ $cartItems->count() > 0 ? $cartItems->sum(fn($item) => $item->dukun->harga) : 0 }};

    // Fungsi untuk menghitung durasi dan total harga
    function calculateTotalPrice() {
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;

        // Reset jika salah satu tanggal belum dipilih
        if (!startDateValue || !endDateValue) {
            totalPriceDisplay.textContent = 'Rp 0';
            return;
        }

        // Parse tanggal ke objek Date
        const startDate = new Date(startDateValue);
        const endDate = new Date(endDateValue);

        // Validasi: Tanggal selesai tidak boleh sebelum tanggal mulai
        if (endDate < startDate) {
            totalPriceDisplay.textContent = 'Tanggal tidak valid';
            // Anda bisa tambahkan style error jika mau
            return;
        }

        // Hitung selisih waktu dalam milidetik
        const timeDifference = endDate.getTime() - startDate.getTime();

        // Hitung durasi dalam hari (inklusif)
        // (selisih / milidetik per hari) + 1
        const durationDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) + 1;

        // Hitung total harga
        const totalPrice = subtotalDailyPrice * durationDays;

        // Format harga ke Rupiah
        const formattedPrice = new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0 // Tidak menampilkan desimal
        }).format(totalPrice);

        // Tampilkan total harga
        totalPriceDisplay.textContent = formattedPrice;
    }

    // Tambahkan event listener ke kedua input tanggal
    startDateInput.addEventListener('change', calculateTotalPrice);
    endDateInput.addEventListener('change', calculateTotalPrice);

    // Hitung saat halaman pertama kali dimuat (jika tanggal sudah terisi dari old input)
    document.addEventListener('DOMContentLoaded', calculateTotalPrice);

</script>
@endpush
</x-app-layout>