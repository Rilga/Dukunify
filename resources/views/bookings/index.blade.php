<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Booking Saya (Riwayat Order)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Session Messages (Dark Mode) --}}
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

            {{-- Card Sewa Aktif (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow mb-8 overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    <h3 class="text-2xl font-bold text-purple-100 mb-6">Sewa Aktif & Pending</h3>
                    
                    <div class="space-y-4">
                        @forelse ($activeBookings as $booking)
                            {{-- Nested Card untuk setiap item --}}
                            <div class="rounded-lg p-4 sm:p-6
                                {{ $booking->status == 'pending_completion' ? 'bg-yellow-900/30 border border-yellow-700/50' : 'bg-gray-900/50 border border-purple-800/30' }}">
                                <div class="flex flex-col sm:flex-row justify-between sm:items-start">
                                    <div class="mb-4 sm:mb-0">
                                        <span class="text-sm font-semibold text-purple-500">{{ $booking->kode_transaksi }}</span>
                                        <h4 class="text-xl font-bold text-purple-300">{{ $booking->dukun->nama_dukun }}</h4>
                                        <a href="{{ route('booking.show', $booking) }}" class="text-xs text-purple-400 hover:text-purple-200 block mt-1 transition duration-300">
                                            Lihat Detail
                                        </a> 
                                        <div class="text-sm text-purple-400 mt-2">
                                            <span>Sewa:</span>
                                            <strong class="text-purple-200">{{ $booking->tanggal_mulai_sewa->format('d M Y') }}</strong>
                                            <span>s/d</span>
                                            <strong class="text-red-400">{{ $booking->tanggal_selesai_sewa->format('d M Y') }}</strong>
                                        </div>
                                    </div>
                                    <div class="text-left sm:text-right flex-shrink-0">
                                        @if ($booking->status == 'aktif')
                                            <form action="{{ route('booking.requestCompletion', $booking) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan sesi ini?');">
                                                @csrf
                                                {{-- Tombol Ajukan (Biru) dengan Efek Mistis --}}
                                                <button type="submit"
                                                        class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 via-sky-600 to-blue-600 rounded-lg hover:from-blue-500 hover:to-sky-500 transition-all duration-300 shadow-lg hover:shadow-blue-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-blue-400/30 animate-mystical-pulse">
                                                    <span class="relative z-10">{{ __('Ajukan Penyelesaian') }}</span>
                                                    <div class="absolute inset-0 mystical-shimmer" style="background: linear-gradient(90deg, transparent, rgba(150, 200, 255, 0.3), transparent);"></div>
                                                </button>
                                            </form>
                                            <div class="text-xs text-purple-500 mt-1">Sesi sedang berlangsung</div>
                                        @elseif ($booking->status == 'pending_completion')
                                            {{-- Badge Kuning (Dark Mode) --}}
                                            <span class="px-3 py-1.5 text-sm font-semibold text-yellow-300 bg-yellow-800/50 border border-yellow-700/50 rounded-full">
                                                Menunggu Persetujuan Admin
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-purple-400">Anda tidak memiliki sewa yang sedang aktif.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Card Riwayat Selesai (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    <h3 class="text-2xl font-bold text-purple-100 mb-6">Riwayat Sesi Selesai</h3>

                    <div class="divide-y divide-purple-900/50">
                        @forelse ($historyBookings as $booking)
                            <div class="py-6">
                                <div class="flex flex-col sm:flex-row justify-between sm:items-start">
                                    <div class="mb-4 sm:mb-0">
                                        <span class="text-sm font-semibold text-purple-500">{{ $booking->kode_transaksi }}</span>
                                        <h4 class="text-lg font-bold text-purple-300">{{ $booking->dukun->nama_dukun }}</h4>
                                        <a href="{{ route('booking.show', $booking) }}" class="text-xs text-purple-400 hover:text-purple-200 block mt-1 transition duration-300">
                                            Lihat Detail
                                        </a> 
                                        <div class="text-sm text-purple-400 mt-2">
                                            <span>Selesai pada:</span>
                                            <strong class="text-purple-200">{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d M Y') : 'N/A' }}</strong>
                                        </div>
                                        
                                        @if ($booking->denda > 0)
                                            <div class="text-sm font-semibold text-red-400 mt-1">
                                                Tagihan Denda: Rp {{ number_format($booking->denda, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="text-left sm:text-right mt-4 sm:mt-0 flex-shrink-0">
                                        @if ($booking->status == 'menunggu_pembayaran_denda')
                                            <form action="{{ route('booking.payDenda', $booking) }}" method="POST" onsubmit="return confirm('Anda akan mengkonfirmasi pembayaran denda ini?');">
                                                @csrf
                                                {{-- Tombol Bayar Denda (Merah) dengan Efek Mistis --}}
                                                <button type="submit"
                                                        class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-red-600 via-rose-600 to-red-600 rounded-lg hover:from-red-500 hover:to-rose-500 transition-all duration-300 shadow-lg hover:shadow-red-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-red-400/30 animate-mystical-pulse">
                                                    <span class="relative z-10">{{ __('Bayar Denda Sekarang') }}</span>
                                                    <div class="absolute inset-0 mystical-shimmer" style="background: linear-gradient(90deg, transparent, rgba(255, 150, 150, 0.3), transparent);"></div>
                                                </button>
                                            </form>
                                        @elseif ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                            {{-- Badge Biru (Dark Mode) --}}
                                            <span class="px-3 py-1.5 text-sm font-semibold text-blue-300 bg-blue-800/50 border border-blue-700/50 rounded-full">
                                                Menunggu Konfirmasi Pembayaran
                                            </span>
                                        @else
                                            {{-- Badge Hijau (Dark Mode) --}}
                                            <span class="px-3 py-1.5 text-sm font-semibold text-green-300 bg-green-800/50 border border-green-700/50 rounded-full">
                                                Selesai
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                             <p class="text-purple-400 py-4">Anda belum memiliki riwayat sewa.</p>
                        @endforelse
                    </div>

                    {{-- Pagination (dengan style kustom) --}}
                    <div class="mt-6 mystical-pagination">
                        {{ $historyBookings->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- Style Kustom untuk Pagination Tailwind di Tema Gelap --}}
    <style>
        .mystical-pagination nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .mystical-pagination .hidden {
            display: none;
        }
        .mystical-pagination p {
            color: #c4b5fd; /* purple-300 */
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        .mystical-pagination a, .mystical-pagination span {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
            background: rgba(17, 24, 39, 0.7); /* glass-dark bg */
            border: 1px solid rgba(139, 92, 246, 0.3); /* glass-dark border */
            color: #c4b5fd; /* purple-300 */
            transition: all 0.3s;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        .mystical-pagination a:hover {
            background: rgba(139, 92, 246, 0.2);
            color: #ddd6fe; /* purple-200 */
        }
        .mystical-pagination .cursor-default span {
            opacity: 0.5;
            background: rgba(17, 24, 39, 0.4);
        }
        /* Current page */
        .mystical-pagination .cursor-default span[aria-current="page"] {
            opacity: 1;
            background: rgba(139, 92, 246, 0.3);
            font-weight: 600;
            color: #ede9fe; /* violet-100 */
        }
        /* Mobile small buttons */
        .mystical-pagination .px-4.py-2, .mystical-pagination .relative.inline-flex {
            padding: 0.5rem 1rem;
        }
    </style>
    
</x-app-layout>