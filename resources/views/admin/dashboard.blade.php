<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- BAGIAN 1: Ringkasan Aksi --}}
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Ringkasan Tugas & Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"> 
                {{-- Widget Persetujuan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-yellow-500">
                    <div class="p-6">
                        <div class="flex items-center">
                             <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Menunggu Tindakan Anda</dt>
                                    <dd class="text-3xl font-bold text-gray-900">{{ $persetujuanCount }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <a href="{{ route('admin.approvals.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Persetujuan &rarr;</a>
                        </div>
                    </div>
                </div>
                {{-- Widget Booking Aktif --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                     <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.084-1.284-.24-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.084-1.284.24-1.857m11.52 1.857a3 3 0 00-5.76 0M12 13a3 3 0 110-6 3 3 0 010 6z" /></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Booking Sedang Aktif</dt>
                                    <dd class="text-3xl font-bold text-gray-900">{{ $bookingAktifCount }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <a href="{{ route('admin.reports.active') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Booking Aktif &rarr;</a>
                        </div>
                    </div>
                </div>
                {{-- Widget Riwayat Selesai --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center">
                             <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Transaksi Telah Selesai</dt>
                                    <dd class="text-3xl font-bold text-gray-900">{{ $riwayatCount }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <a href="{{ route('admin.reports.history') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Riwayat Booking &rarr;</a>
                        </div>
                    </div>
                </div>
            </div> 

            {{-- BAGIAN 2: Statistik Dasar --}}
            <h3 class="text-lg font-semibold text-gray-700 mb-4 mt-8">Statistik Platform</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Widget Total Dukun --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                             <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Dukun</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $totalDukun }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget Total Klien --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                         <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Klien</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $totalKlien }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                 {{-- Widget Total Pendapatan (DENGAN FILTER) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-4 text-sm flex justify-end space-x-2">
                            <a href="{{ route('admin.dashboard', ['revenue_filter' => 'week']) }}" 
                               class="px-3 py-1 rounded-md {{ $revenueFilter == 'week' ? 'bg-indigo-600 text-white font-semibold' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Minggu Ini
                            </a>
                             <a href="{{ route('admin.dashboard', ['revenue_filter' => 'month']) }}" 
                               class="px-3 py-1 rounded-md {{ $revenueFilter == 'month' ? 'bg-indigo-600 text-white font-semibold' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Bulan Ini
                            </a>
                             <a href="{{ route('admin.dashboard', ['revenue_filter' => 'all']) }}" 
                               class="px-3 py-1 rounded-md {{ $revenueFilter == 'all' ? 'bg-indigo-600 text-white font-semibold' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                Semua
                            </a>
                        </div>

                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0c-1.657 0-3-.895-3-2s1.343-2 3-2 3-.895 3-2-1.343-2-3-2m0 8c1.11 0 2.08-.402 2.599-1M12 8V7m0 1v8m0 0H9m3 0h3m-3 0V7m0 11a9 9 0 110-18 9 9 0 010 18z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Pendapatan (Selesai)</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </div>
    </div>
</x-app-layout>