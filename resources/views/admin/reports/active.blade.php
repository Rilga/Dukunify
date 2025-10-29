<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Monitoring Booking Aktif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Utama (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    <p class="text-purple-300 mb-6 text-sm">Daftar ini menampilkan semua unit (Dukun) yang sedang disewa oleh Klien.</p>

                    {{-- Wrapper untuk tabel agar bisa scroll di mobile --}}
                    <div class="overflow-x-auto rounded-lg border border-purple-800/30">
                        <table class="min-w-full divide-y divide-purple-900/50">
                            {{-- Header Tabel (Dark Mode) --}}
                            <thead class="bg-gray-900/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Klien</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Dukun (Unit)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Batas Waktu</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            {{-- Body Tabel (Dark Mode) --}}
                            <tbody class="divide-y divide-purple-800/30">
                                @forelse ($activeBookings as $booking)
                                    <tr class="hover:bg-gray-900/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-200">{{ $booking->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">{{ $booking->dukun->nama_dukun }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-400 font-semibold">{{ $booking->tanggal_selesai_sewa->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($booking->status == 'aktif')
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-800/50 text-sky-300 border border-sky-700/50">
                                                    Aktif
                                                </span>
                                            @elseif ($booking->status == 'pending_completion')
                                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-800/50 text-yellow-300 border border-yellow-700/50">
                                                    Menunggu Persetujuan
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-purple-400 text-center">Tidak ada booking yang sedang aktif.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (dengan style kustom) --}}
                    <div class="mt-6 mystical-pagination">
                        {{ $activeBookings->links() }}
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