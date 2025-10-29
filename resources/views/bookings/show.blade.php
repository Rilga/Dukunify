<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Detail Booking: ') . $booking->kode_transaksi }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Mengganti card putih dengan card glass-dark --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 md:p-8 text-purple-100 space-y-8">

                    {{-- Status Booking (Dark Mode) --}}
                    <div class="text-center">
                        <span class="px-4 py-1.5 text-lg font-semibold rounded-full 
                            @if($booking->status == 'selesai') bg-green-800/50 text-green-300 border border-green-700/50
                            @elseif($booking->status == 'menunggu_konfirmasi_pembayaran') bg-blue-800/50 text-blue-300 border border-blue-700/50
                            @elseif($booking->status == 'menunggu_pembayaran_denda') bg-red-800/50 text-red-300 border border-red-700/50
                            @elseif($booking->status == 'pending_completion') bg-yellow-800/50 text-yellow-300 border border-yellow-700/50
                            @elseif($booking->status == 'aktif') bg-sky-800/50 text-sky-300 border border-sky-700/50
                            @else bg-gray-800/50 text-gray-300 border border-gray-700/50 @endif">
                            Status: {{ Str::headline($booking->status) }}
                        </span>
                    </div>

                    {{-- Detail Waktu --}}
                    <div>
                        <h3 class="text-xl font-bold text-purple-200 border-b border-purple-700/50 pb-3 mb-4">Detail Waktu</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                            <dt class="font-medium text-purple-400">Tanggal Mulai Sewa:</dt>
                            <dd class="text-purple-200">{{ $booking->tanggal_mulai_sewa->format('d M Y') }}</dd>
                            
                            <dt class="font-medium text-purple-400">Tanggal Selesai Sewa (Batas):</dt>
                            <dd class="font-semibold text-red-400">{{ $booking->tanggal_selesai_sewa->format('d M Y') }}</dd>
                            
                            <dt class="font-medium text-purple-400">Tanggal Pengajuan Penyelesaian:</dt>
                            <dd class="text-purple-200">{{ $booking->tanggal_pengajuan_pengembalian ? $booking->tanggal_pengajuan_pengembalian->format('d M Y, H:i') : '-' }}</dd>
                            
                            <dt class="font-medium text-purple-400">Tanggal Selesai Aktual:</dt>
                            <dd class="text-purple-200">{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d M Y') : '-' }}</dd>
                        </dl>
                    </div>

                    {{-- Detail Dukun --}}
                    <div>
                        <h3 class="text-xl font-bold text-purple-200 border-b border-purple-700/50 pb-3 mb-4">Detail Dukun (Unit)</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                            <dt class="font-medium text-purple-400">Nama Dukun:</dt>
                            <dd class="font-semibold text-purple-200">{{ $booking->dukun->nama_dukun }}</dd>
                            
                            <dt class="font-medium text-purple-400">Kode Unit:</dt>
                            <dd class="text-purple-200">{{ $booking->dukun->kode_dukun }}</dd>
                            
                            <dt class="font-medium text-purple-400">Kategori:</dt>
                            <dd class="text-purple-200">
                                @foreach ($booking->dukun->categories as $category)
                                    {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </dd>
                            
                            <dt class="font-medium text-purple-400">Harga per Hari:</dt>
                            <dd class="text-purple-200">Rp {{ number_format($booking->dukun->harga, 0, ',', '.') }}</dd>
                        </dl>
                    </div>

                    {{-- Detail Biaya --}}
                    <div>
                        <h3 class="text-xl font-bold text-purple-200 border-b border-purple-700/50 pb-3 mb-4">Rincian Biaya</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                            <dt class="font-medium text-purple-400">Total Biaya Sewa:</dt>
                            <dd class="text-purple-200">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</dd>
                            
                            <dt class="font-medium text-purple-400">Denda Keterlambatan:</dt>
                            <dd class="font-semibold {{ $booking->denda > 0 ? 'text-red-400' : 'text-purple-200' }}">
                                Rp {{ number_format($booking->denda, 0, ',', '.') }}
                            </dd>
                        </dl>
                    </div>

                    {{-- Tombol Aksi (jika perlu) --}}
                    @if ($booking->status == 'menunggu_pembayaran_denda')
                        <div class="mt-6 pt-6 border-t border-purple-700/50 text-center">
                             <form action="{{ route('booking.payDenda', $booking) }}" method="POST" onsubmit="return confirm('Anda akan mengkonfirmasi pembayaran denda ini?');">
                                @csrf
                                {{-- Tombol Bayar Denda (Merah) dengan Efek Mistis --}}
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-3 text-base font-semibold text-white bg-gradient-to-r from-red-600 via-rose-600 to-red-600 rounded-lg hover:from-red-500 hover:to-rose-500 transition-all duration-300 shadow-lg hover:shadow-red-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-red-400/30">
                                    <span class="relative z-10">{{ __('Bayar Denda Sekarang') }}</span>
                                    <div class="absolute inset-0 mystical-shimmer" style="background: linear-gradient(90deg, transparent, rgba(255, 150, 150, 0.3), transparent);"></div>
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-6 text-center">
                        <a href="{{ route('booking.index') }}" class="text-sm text-purple-400 hover:text-purple-200 transition duration-300">&larr; Kembali ke Booking Saya</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>