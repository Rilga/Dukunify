<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Jasa Dukun') }}
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
            <div class="mb-6">
                <form action="{{ route('user.dashboard') }}" method="GET">
                    <div class="flex">
                        <x-text-input 
                            type="text" 
                            name="search" 
                            class="w-full" 
                            placeholder="Cari berdasarkan nama dukun..." 
                            :value="$search ?? ''" 
                        />
                        <x-primary-button class="ms-3">
                            {{ __('Cari') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($dukuns->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            
                            @foreach ($dukuns as $dukun)
                                <x-dukun-card :dukun="$dukun" />
                            @endforeach

                        </div>

                        <div class="mt-8">
                            {{-- appends() penting agar pencarian tetap terbawa saat pindah halaman --}}
                            {{ $dukuns->appends(['search' => $search ?? ''])->links() }}
                        </div>

                    @else
                        <div class="text-center py-12">
                            <h3 class="text-lg font-medium text-gray-700">
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