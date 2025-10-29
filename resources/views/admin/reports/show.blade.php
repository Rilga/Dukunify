<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Booking: ') . $booking->kode_transaksi }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 space-y-6">

                     {{-- Status Booking --}}
                    <div class="text-center mb-6">
                        <span class="px-4 py-1 text-lg font-semibold rounded-full 
                            @if($booking->status == 'selesai') bg-green-200 text-green-800
                            @elseif($booking->status == 'menunggu_konfirmasi_pembayaran') bg-blue-200 text-blue-800
                            @elseif($booking->status == 'menunggu_pembayaran_denda') bg-red-200 text-red-800
                            @elseif($booking->status == 'pending_completion') bg-yellow-200 text-yellow-800
                            @else bg-gray-200 text-gray-800 @endif">
                            Status: {{ Str::headline($booking->status) }}
                        </span>
                    </div>

                    {{-- Detail Klien --}}
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2 mb-3">Detail Klien</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <dt class="font-medium text-gray-500">Nama Klien:</dt>
                            <dd class="font-semibold">{{ $booking->user->name }}</dd>
                            <dt class="font-medium text-gray-500">Email Klien:</dt>
                            <dd>{{ $booking->user->email }}</dd>
                        </dl>
                    </div>

                    {{-- Detail Waktu --}}
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2 mb-3">Detail Waktu</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <dt class="font-medium text-gray-500">Tanggal Mulai Sewa:</dt>
                            <dd>{{ $booking->tanggal_mulai_sewa->format('d M Y') }}</dd>
                            <dt class="font-medium text-gray-500">Tanggal Selesai Sewa (Batas):</dt>
                            <dd class="font-semibold text-red-600">{{ $booking->tanggal_selesai_sewa->format('d M Y') }}</dd>
                            <dt class="font-medium text-gray-500">Tanggal Pengajuan Penyelesaian:</dt>
                            <dd>{{ $booking->tanggal_pengajuan_pengembalian ? $booking->tanggal_pengajuan_pengembalian->format('d M Y, H:i') : '-' }}</dd>
                            <dt class="font-medium text-gray-500">Tanggal Selesai Aktual (Dikonfirmasi):</dt>
                            <dd>{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d M Y') : '-' }}</dd>
                        </dl>
                    </div>

                    {{-- Detail Dukun --}}
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2 mb-3">Detail Dukun (Unit)</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <dt class="font-medium text-gray-500">Nama Dukun:</dt>
                            <dd class="font-semibold">{{ $booking->dukun->nama_dukun }}</dd>
                            <dt class="font-medium text-gray-500">Kode Unit:</dt>
                            <dd>{{ $booking->dukun->kode_dukun }}</dd>
                            <dt class="font-medium text-gray-500">Kategori:</dt>
                            <dd>
                                @foreach ($booking->dukun->categories as $category)
                                    {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </dd>
                            <dt class="font-medium text-gray-500">Harga per Hari:</dt>
                            <dd>Rp {{ number_format($booking->dukun->harga, 0, ',', '.') }}</dd>
                        </dl>
                    </div>

                    {{-- Detail Biaya --}}
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2 mb-3">Rincian Biaya</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <dt class="font-medium text-gray-500">Total Biaya Sewa:</dt>
                            <dd>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</dd>
                            <dt class="font-medium text-gray-500">Denda Keterlambatan:</dt>
                            <dd class="font-semibold {{ $booking->denda > 0 ? 'text-red-600' : '' }}">Rp {{ number_format($booking->denda, 0, ',', '.') }}</dd>
                        </dl>
                    </div>

                    {{-- Tombol Aksi Admin (jika perlu) --}}
                     @if ($booking->status == 'menunggu_konfirmasi_pembayaran')
                        <div class="mt-6 pt-6 border-t text-center">
                             <form action="{{ route('admin.approvals.confirmPayment', $booking) }}" method="POST" onsubmit="return confirm('Konfirmasi pembayaran ini dan selesaikan transaksi?');">
                                @csrf
                                <x-primary-button class="bg-green-600 hover:bg-green-700 px-8 py-3 text-base">
                                    {{ __('Konfirmasi Pembayaran & Selesaikan') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @endif


                    <div class="mt-6 text-center">
                        <a href="{{ route('admin.reports.history') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; Kembali ke Riwayat Booking</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>