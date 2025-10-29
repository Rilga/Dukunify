<x-app-layout>
    <x-slot name="header">
        {{-- MODIFIKASI: Mengganti 'text-gray-800' menjadi 'text-white' --}}
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Katalog Jasa Dukun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- MODIFIKASI: Style notifikasi diubah ke tema gelap --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-900/50 text-green-300 border border-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-900/50 text-red-300 border border-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="mb-6">
                <form action="{{ route('user.dashboard') }}" method="GET">
                    <div class="flex">
                        {{-- 
                            MODIFIKASI: 
                            - Menambahkan style dark-mode ke text-input.
                            - Latar belakang gelap, border ungu, teks putih.
                        --}}
                        <x-text-input 
                            type="text" 
                            name="search" 
                            class="w-full bg-gray-800/50 border-purple-700/50 text-white placeholder:text-gray-400 focus:border-purple-500 focus:ring-purple-500 rounded-lg" 
                            placeholder="Cari berdasarkan nama dukun..." 
                            :value="$search ?? ''" 
                        />
                        
                        {{-- 
                            MODIFIKASI: 
                            - Mengubah style primary-button agar sesuai tema (violet).
                        --}}
                        <x-primary-button class="ms-3 bg-violet-600 hover:bg-violet-700 focus:bg-violet-700 active:bg-violet-800 focus:ring-violet-500">
                            {{ __('Cari') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- 
                MODIFIKASI: 
                - Mengganti 'bg-white', 'shadow-sm', 'sm:rounded-lg'
                - Menggunakan 'glass-dark' dan style yang konsisten dengan kartu.
            --}}
            <div class="glass-dark overflow-hidden shadow-lg shadow-purple-900/50 sm:rounded-2xl">
                {{-- MODIFIKASI: Mengganti 'text-gray-900' menjadi 'text-gray-100' --}}
                <div class="p-6 text-gray-100">
                    
                    @if ($dukuns->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            
                            @foreach ($dukuns as $dukun)
                                {{-- Ini akan otomatis menggunakan 'dukun-card.blade.php' yang sudah kita modifikasi --}}
                                <x-dukun-card :dukun="$dukun" />
                            @endforeach

                        </div>

                        <div class="mt-8">
                            {{-- 
                                CATATAN PENTING:
                                Style pagination default Laravel (links()) dibuat untuk tema 'light'.
                                Tampilannya mungkin akan terlihat 'putih' dan tidak serasi.
                                Untuk memperbaikinya, Anda perlu mem-publish file view pagination:
                                php artisan vendor:publish --tag=laravel-pagination
                                Dan mengedit file-file di 'resources/views/vendor/pagination' 
                                agar menggunakan class Tailwind 'dark mode' (text-gray-300, bg-gray-800, dll.)
                            --}}
                            {{ $dukuns->appends(['search' => $search ?? ''])->links() }}
                        </div>

                    @else
                        <div class="text-center py-12">
                            {{-- MODIFIKASI: Mengganti 'text-gray-700' menjadi 'text-purple-300' --}}
                            <h3 class="text-lg font-medium text-purple-300">
                                @if ($search)
                                    Dukun dengan nama "{{ $search }}" tidak ditemukan.
                                @else
                                    Saat ini belum ada Dukun yang tersedia.
                                @endif
                            </h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>