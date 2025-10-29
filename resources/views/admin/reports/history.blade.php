<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Riwayat Booking Klien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses/Error (Dark Mode) --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-800/50 border border-green-600/50 text-green-300 rounded-lg shadow-lg shadow-green-900/50">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-800/50 border border-red-600/50 text-red-300 rounded-lg shadow-lg shadow-red-900/50">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Card Filter (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden mb-8">
                <div class="p-6 sm:p-8 text-purple-100">
                    <h4 class="text-lg font-semibold mb-4 text-purple-200">Filter Laporan</h4>
                    <form action="{{ route('admin.reports.history') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            {{-- Filter Nama Klien --}}
                            <div>
                                <label for="search_user" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Nama Klien') }}</label>
                                <input id="search_user" type="text" name="search_user" value="{{ request('search_user') }}"
                                       class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            </div>
                            
                            {{-- Filter Status --}}
                            <div>
                                <label for="search_status" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Status') }}</label>
                                <select id="search_status" name="search_status" 
                                        class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 focus:bg-gray-800">
                                    <option value="" class="bg-gray-900 text-gray-300">Semua Status</option>
                                    <option value="selesai" {{ request('search_status') == 'selesai' ? 'selected' : '' }} class="bg-gray-900 text-gray-300">Selesai</option>
                                    <option value="menunggu_konfirmasi_pembayaran" {{ request('search_status') == 'menunggu_konfirmasi_pembayaran' ? 'selected' : '' }} class="bg-gray-900 text-gray-300">Menunggu Konfirmasi</option>
                                    <option value="menunggu_pembayaran_denda" {{ request('search_status') == 'menunggu_pembayaran_denda' ? 'selected' : '' }} class="bg-gray-900 text-gray-300">Menunggu Denda</option>
                                    <option value="aktif" {{ request('search_status') == 'aktif' ? 'selected' : '' }} class="bg-gray-900 text-gray-300">Aktif</option>
                                    <option value="pending_completion" {{ request('search_status') == 'pending_completion' ? 'selected' : '' }} class="bg-gray-900 text-gray-300">Pending Selesai</option>
                                </select>
                            </div>

                            {{-- Filter Tanggal Mulai --}}
                            <div>
                                <label for="start_date" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Dari Tanggal Selesai') }}</label>
                                <input id="start_date" type="date" name="start_date" value="{{ request('start_date') }}"
                                       class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500" style="color-scheme: dark;">
                            </div>
                            
                            {{-- Filter Tanggal Akhir --}}
                            <div>
                                <label for="end_date" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Sampai Tanggal Selesai') }}</label>
                                <input id="end_date" type="date" name="end_date" value="{{ request('end_date') }}"
                                       class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500" style="color-scheme: dark;">
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6 space-x-4">
                            {{-- Tombol Reset --}}
                            <a href="{{ route('admin.reports.history') }}" class="text-sm text-purple-400 hover:text-purple-200 transition duration-300">Reset Filter</a>
                            
                            {{-- Tombol Filter (Mystical) --}}
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                                <span class="relative z-10">{{ __('Filter Laporan') }}</span>
                                <div class="absolute inset-0 mystical-shimmer"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Card Tabel Laporan (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    <div class="mb-6 text-right">
                        {{-- Tombol Cetak (Dark) --}}
                        <a href="{{ route('admin.reports.print', request()->query()) }}"
                           class="inline-flex items-center px-6 py-2.5 text-xs font-semibold uppercase tracking-widest text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg shadow-lg hover:shadow-gray-700/50 transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            Cetak Laporan (PDF)
                        </a>
                    </div>
                    
                    {{-- Wrapper untuk tabel agar bisa scroll di mobile --}}
                    <div class="overflow-x-auto rounded-lg border border-purple-800/30">
                        <table class="min-w-full divide-y divide-purple-900/50">
                            {{-- Header Tabel (Dark Mode) --}}
                            <thead class="bg-gray-900/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Klien</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Dukun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Selesai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Denda</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            {{-- Body Tabel (Dark Mode) --}}
                            <tbody class="divide-y divide-purple-800/30">
                                @forelse ($historyBookings as $booking)
                                    <tr class="hover:bg-gray-900/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-200">
                                            {{ $booking->user->name }}
                                            {{-- Link Detail (Dark) --}}
                                            <a href="{{ route('admin.reports.show', $booking) }}" class="text-xs text-purple-400 hover:text-purple-200 block mt-1 transition duration-300">Lihat Detail</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">{{ $booking->dukun->nama_dukun }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d M Y') : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $booking->denda > 0 ? 'text-red-400 font-semibold' : 'text-purple-300' }}">Rp {{ number_format($booking->denda, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{-- Badges Status (Dark) --}}
                                            @if ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-800/50 text-blue-300 border border-blue-700/50">
                                                    Menunggu Konfirmasi
                                                </span>
                                            @elseif ($booking->status == 'menunggu_pembayaran_denda')
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-800/50 text-red-300 border border-red-700/50">
                                                    Menunggu Denda
                                                </span>
                                            @elseif ($booking->status == 'selesai')
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-800/50 text-green-300 border border-green-700/50">
                                                    Selesai
                                                </span>
                                            @elseif ($booking->status == 'aktif')
                                                 <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-800/50 text-sky-300 border border-sky-700/50">
                                                    Aktif
                                                </span>
                                            @elseif ($booking->status == 'pending_completion')
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-800/50 text-yellow-300 border border-yellow-700/50">
                                                    Pending Selesai
                                                </span>
                                            @else
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-700/50 text-gray-300 border border-gray-600/50">
                                                    {{ Str::headline($booking->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-purple-400 text-center">Tidak ada data riwayat yang cocok dengan filter.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (dengan style kustom) --}}
                    <div class="mt-6 mystical-pagination">
                         {{-- Pastikan query string filter ikut terbawa saat paginasi --}}
                        {{ $historyBookings->appends(request()->query())->links() }}
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