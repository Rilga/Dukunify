<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Persetujuan & Konfirmasi (To-Do List)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Utama (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    
                    {{-- Notifikasi Sukses/Error (Dark Mode) --}}
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

                    <p class="text-purple-300 mb-6 text-sm">Halaman ini berisi semua tugas yang menunggu tindakan Anda (Persetujuan Selesai Sesi & Konfirmasi Pembayaran Denda).</p>

                    {{-- Wrapper untuk tabel agar bisa scroll di mobile --}}
                    <div class="overflow-x-auto rounded-lg border border-purple-800/30">
                        <table class="min-w-full divide-y divide-purple-900/50">
                            {{-- Header Tabel (Dark Mode) --}}
                            <thead class="bg-gray-900/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Klien</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Dukun</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Status / Detail</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-purple-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            {{-- Body Tabel (Dark Mode) --}}
                            <tbody class="divide-y divide-purple-800/30">
                                @forelse ($pendingBookings as $booking)
                                    <tr class="hover:bg-gray-900/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-200">{{ $booking->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">{{ $booking->dukun->nama_dukun }}</td>
                                        
                                        {{-- Kolom Status/Detail (Dark Mode) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">
                                            @if ($booking->status == 'pending_completion')
                                                <div class="font-semibold text-yellow-300">Menunggu Persetujuan Selesai</div>
                                                <div class="text-xs">Batas: {{ $booking->tanggal_selesai_sewa->format('d M Y') }}</div>
                                                <div class="text-xs">Ajuan: {{ $booking->tanggal_pengajuan_pengembalian->format('d M Y, H:i') }}</div>
                                                
                                                @if ($booking->tanggal_pengajuan_pengembalian->startOfDay()->isAfter($booking->tanggal_selesai_sewa->startOfDay()))
                                                    <span class="mt-1 px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-800/50 text-red-300 border border-red-700/50">
                                                        Terlambat
                                                    </span>
                                                @endif
                                            
                                            @elseif ($booking->status == 'menunggu_pembayaran_denda')
                                                <div class="font-semibold text-red-300">Menunggu Pembayaran Klien</div>
                                                <div class="font-bold text-red-400">Denda: Rp {{ number_format($booking->denda, 0, ',', '.') }}</div>
                                            @elseif ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                                <div class="font-semibold text-blue-300">Menunggu Konfirmasi Pembayaran</div>
                                                <div class="font-bold text-red-400">Denda: Rp {{ number_format($booking->denda, 0, ',', '.') }}</div>
                                            @endif
                                        </td>

                                        {{-- Kolom Aksi (dengan Tombol Mystical) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($booking->status == 'pending_completion')
                                                <form action="{{ route('admin.approvals.approve', $booking) }}" method="POST" onsubmit="return confirm('Anda akan menyetujui penyelesaian ini. Sistem akan menghitung denda jika ada. Lanjutkan?');">
                                                    @csrf
                                                    <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-gradient-to-r from-blue-600 via-sky-600 to-blue-600 rounded-lg hover:from-blue-500 hover:to-sky-500 transition-all duration-300 shadow-lg hover:shadow-blue-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-blue-400/30">
                                                        <span class="relative z-10">{{ __('Setujui Selesai') }}</span>
                                                        <div class="absolute inset-0 mystical-shimmer" style="background: linear-gradient(90deg, transparent, rgba(147, 197, 253, 0.3), transparent);"></div>
                                                    </button>
                                                </form>
                                            
                                            @elseif ($booking->status == 'menunggu_pembayaran_denda')
                                                <span class="text-xs text-purple-400 italic">Menunggu Klien</span>
                                            
                                            @elseif ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                                <form action="{{ route('admin.approvals.confirmPayment', $booking) }}" method="POST" onsubmit="return confirm('Konfirmasi pembayaran ini dan selesaikan transaksi?');">
                                                    @csrf
                                                     <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-gradient-to-r from-green-600 via-emerald-600 to-green-600 rounded-lg hover:from-green-500 hover:to-emerald-500 transition-all duration-300 shadow-lg hover:shadow-green-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-green-400/30">
                                                        <span class="relative z-10">{{ __('Konfirmasi Bayar') }}</span>
                                                        <div class="absolute inset-0 mystical-shimmer" style="background: linear-gradient(90deg, transparent, rgba(110, 231, 183, 0.3), transparent);"></div>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-purple-400 text-center">
                                            Tidak ada tugas yang tertunda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (dengan style kustom) --}}
                    <div class="mt-6 mystical-pagination">
                        {{ $pendingBookings->links() }}
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