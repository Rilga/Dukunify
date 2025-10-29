<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Booking Klien') }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h4 class="text-lg font-semibold mb-4">Filter Laporan</h4>
                    <form action="{{ route('admin.reports.history') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <x-input-label for="search_user" :value="__('Nama Klien')" />
                                <x-text-input id="search_user" class="block mt-1 w-full" type="text" name="search_user" :value="request('search_user')" />
                            </div>
                            <div>
                                <x-input-label for="search_status" :value="__('Status')" />
                                <select id="search_status" name="search_status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Semua Status</option>
                                    <option value="selesai" {{ request('search_status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="menunggu_konfirmasi_pembayaran" {{ request('search_status') == 'menunggu_konfirmasi_pembayaran' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                    <option value="menunggu_pembayaran_denda" {{ request('search_status') == 'menunggu_pembayaran_denda' ? 'selected' : '' }}>Menunggu Denda</option>
                                    <option value="aktif" {{ request('search_status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="pending_completion" {{ request('search_status') == 'pending_completion' ? 'selected' : '' }}>Pending Selesai</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="start_date" :value="__('Dari Tanggal')" />
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="request('start_date')" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('Sampai Tanggal')" />
                                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="request('end_date')" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.reports.history') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Reset</a>
                            <x-primary-button>
                                {{ __('Filter') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 text-right">
                        <a href="{{ route('admin.reports.print', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Cetak Laporan (PDF)
                        </a>
                    </div>
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dukun</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($historyBookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $booking->user->name }}
                                        {{-- <<< TAMBAHKAN LINK DETAIL DI SINI --}}
                                        <a href="{{ route('admin.reports.show', $booking) }}" class="text-xs text-indigo-600 hover:text-indigo-800 block mt-1">Lihat Detail</a>
                                        {{-- <<< AKHIR TAMBAHAN --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->dukun->nama_dukun }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d M Y') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">Rp {{ number_format($booking->denda, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($booking->status == 'menunggu_konfirmasi_pembayaran')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Menunggu Konfirmasi
                                            </span>
                                        @elseif ($booking->status == 'menunggu_pembayaran_denda')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Menunggu Denda
                                            </span>
                                        @elseif ($booking->status == 'selesai')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ Str::headline($booking->status) }} {{-- <<< Gunakan Str::headline agar lebih rapi --}}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data riwayat yang cocok dengan filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $historyBookings->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>