<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Dukun: ') . $dukun->nama_dukun }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    
                    {{-- Gambar Dukun (Revisi 5) --}}
                    <div class="p-6 flex items-center justify-center bg-gray-100">
                        @if ($dukun->image)
                            <img src="{{ Storage::url($dukun->image) }}" alt="{{ $dukun->nama_dukun }}" class="w-full h-auto max-h-96 object-contain rounded-lg shadow-md">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-64 w-64 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        @endif
                    </div>
                    {{-- <<< Akhir Gambar --}}
                    
                    <div class="p-8">
                        <div class="mb-4">
                            @foreach ($dukun->categories as $category)
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        <span class="text-sm font-semibold text-gray-500 uppercase tracking-wide">{{ $dukun->kode_dukun }}</span>
                        
                        <h1 class="text-4xl font-bold text-gray-900 mt-1">{{ $dukun->nama_dukun }}</h1>
                        
                        <div class="mt-4 text-3xl font-semibold text-indigo-600">
                            Rp {{ number_format($dukun->harga, 0, ',', '.') }} <span class="text-base text-gray-500">/ Hari</span> {{-- <<< UBAH INI --}}
                        </div>

                        <p class="mt-6 text-gray-600">
                            {{ $dukun->description ?? 'Tidak ada deskripsi.' }}
                        </p>

                        <form action="{{ route('cart.store', $dukun) }}" method="POST" class="mt-8">
                            @csrf
                            <x-primary-button class="w-full text-center py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                {{ __('Tambah ke Keranjang') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>