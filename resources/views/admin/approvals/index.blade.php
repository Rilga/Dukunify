<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan & Konfirmasi (To-Do List)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
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

                    <p class="text-gray-600 mb-4">Halaman ini berisi semua tugas yang menunggu tindakan Anda (Persetujuan Selesai Sesi & Konfirmasi Pembayaran Denda).</p>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dukun</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status / Detail</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pendingBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->dukun->nama_dukun }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($booking->status == 'pending_completion')
                                            <div class="font-semibold text-yellow-700">Menunggu Persetujuan Selesai</div>
                                            <div>Batas: {{ $booking->tanggal_selesai_sewa->format('d M Y') }}</div>
                                            <div>Ajuan: {{ $booking->tanggal_pengajuan_pengembalian->format('d M Y, H:i') }}</div>
                                            
                                            @if ($booking->tanggal_pengajuan_pengembalian->startOfDay()->isAfter($booking->tanggal_selesai_sewa->startOfDay()))
                                                <span class="px-2 py-0.5 text-xs font-semibold text-red-800 bg-red-200 rounded-full">
                                                    Terlambat
                                                </span>
                                            @endif
                                        
                                        @elseif ($booking->status == 'menunggu_pembayaran_denda')
                                            <div class="font-semibold text-red-700">Menunggu Pembayaran Klien</div>
                                            <div class="font-bold text-red-600">Denda: Rp {{ number_format($booking->denda, 0, ',', '.') }}</div>
                                        @elseif ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                            <div class="font-semibold text-blue-700">Menunggu Konfirmasi Pembayaran</div>
                                            <div class="font-bold text-red-600">Denda: Rp {{ number_format($booking->denda, 0, ',', '.') }}</div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if ($booking->status == 'pending_completion')
                                            <form action="{{ route('admin.approvals.approve', $booking) }}" method="POST" onsubmit="return confirm('Anda akan menyetujui penyelesaian ini. Sistem akan menghitung denda jika ada. Lanjutkan?');">
                                                @csrf
                                                <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                                    {{ __('Setujui Selesai') }}
                                                </x-primary-button>
                                            </form>
                                        
                                        @elseif ($booking->status == 'menunggu_pembayaran_denda')
                                            <span class="text-xs text-gray-500 italic">Menunggu Klien</span>
                                        @elseif ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                            <form action="{{ route('admin.approvals.confirmPayment', $booking) }}" method="POST" onsubmit="return confirm('Konfirmasi pembayaran ini dan selesaikan transaksi?');">
                                                @csrf
                                                <x-primary-button class="bg-green-600 hover:bg-green-700">
                                                    {{ __('Konfirmasi Bayar') }}
                                                </x-primary-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        Tidak ada tugas yang tertunda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $pendingBookings->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>