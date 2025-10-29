<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Saya (Riwayat Order)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Sewa Aktif & Pending</h3>
                    
                    @forelse ($activeBookings as $booking)
                        <div class="p-4 border rounded-md mb-4 {{ $booking->status == 'pending_completion' ? 'bg-yellow-50' : '' }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-sm font-semibold text-gray-500">{{ $booking->kode_transaksi }}</span>
                                    <h4 class="text-xl font-bold text-indigo-700">{{ $booking->dukun->nama_dukun }}</h4>
                                    {{-- <<< TAMBAHKAN LINK DETAIL DI SINI (AKTIF) --}}
                                    <a href="{{ route('booking.show', $booking) }}" class="text-xs text-indigo-600 hover:text-indigo-800 block mt-1">Lihat Detail</a> 
                                    {{-- <<< AKHIR TAMBAHAN --}}
                                    <div class="text-sm text-gray-600 mt-2">
                                        <span>Sewa:</span>
                                        <strong>{{ $booking->tanggal_mulai_sewa->format('d M Y') }}</strong>
                                        <span>s/d</span>
                                        <strong class="text-red-600">{{ $booking->tanggal_selesai_sewa->format('d M Y') }}</strong>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if ($booking->status == 'aktif')
                                        <form action="{{ route('booking.requestCompletion', $booking) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan sesi ini?');">
                                            @csrf
                                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                                {{ __('Ajukan Penyelesaian') }}
                                            </x-primary-button>
                                        </form>
                                        <div class="text-xs text-gray-500 mt-1">Sesi sedang berlangsung</div>
                                    @elseif ($booking->status == 'pending_completion')
                                        <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded-full">
                                            Menunggu Persetujuan Admin
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Anda tidak memiliki sewa yang sedang aktif.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Riwayat Sesi Selesai</h3>

                    <div class="divide-y divide-gray-200">
                    @forelse ($historyBookings as $booking)
                        <div class="py-4">
                            <div class="flex flex-col sm:flex-row justify-between sm:items-start">
                                <div>
                                    <span class="text-sm font-semibold text-gray-500">{{ $booking->kode_transaksi }}</span>
                                    <h4 class="text-lg font-bold text-gray-700">{{ $booking->dukun->nama_dukun }}</h4>
                                    {{-- <<< TAMBAHKAN LINK DETAIL DI SINI (RIWAYAT) --}}
                                    <a href="{{ route('booking.show', $booking) }}" class="text-xs text-indigo-600 hover:text-indigo-800 block mt-1">Lihat Detail</a> 
                                    {{-- <<< AKHIR TAMBAHAN --}}
                                    <div class="text-sm text-gray-600 mt-2">
                                        <span>Selesai pada:</span>
                                        <strong>{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d M Y') : 'N/A' }}</strong>
                                    </div>
                                    
                                    @if ($booking->denda > 0)
                                        <div class="text-sm font-semibold text-red-600 mt-1">
                                            Tagihan Denda: Rp {{ number_format($booking->denda, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="text-left sm:text-right mt-4 sm:mt-0">
                                    @if ($booking->status == 'menunggu_pembayaran_denda')
                                        <form action="{{ route('booking.payDenda', $booking) }}" method="POST" onsubmit="return confirm('Anda akan mengkonfirmasi pembayaran denda ini?');">
                                            @csrf
                                            <x-primary-button class="bg-red-600 hover:bg-red-700">
                                                {{ __('Bayar Denda Sekarang') }}
                                            </x-primary-button>
                                        </form>
                                    @elseif ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                        <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-200 rounded-full">
                                            Menunggu Konfirmasi Pembayaran
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-200 rounded-full">
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                         <p class="text-gray-600">Anda belum memiliki riwayat sewa.</p>
                    @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $historyBookings->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>