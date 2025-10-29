@props(['dukun'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 flex flex-col"> {{-- <<< Tambahkan flex flex-col --}}
    
    {{-- Gambar Dukun (Revisi 5) --}}
    <div class="h-48 w-full bg-gray-200 flex-shrink-0"> {{-- <<< Tambahkan flex-shrink-0 --}}
        @if ($dukun->image)
            <img src="{{ Storage::url($dukun->image) }}" alt="{{ $dukun->nama_dukun }}" class="h-full w-full object-cover">
        @else
            <div class="h-full w-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        @endif
    </div>
    {{-- <<< Akhir Gambar --}}

    <div class="p-6 flex flex-col flex-grow"> {{-- <<< Tambahkan flex flex-col flex-grow --}}
        <div class="mb-2">
            @forelse ($dukun->categories as $category)
                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                    {{ $category->name }}
                </span>
            @empty
                <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                    Tanpa Kategori
                </span>
            @endforelse
        </div>

        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
            {{ $dukun->kode_dukun }}
        </div>

        <h3 class="mt-1 text-xl font-bold text-gray-900 truncate">
            {{ $dukun->nama_dukun }}
        </h3>

        <div class="mt-2 text-lg font-semibold text-indigo-600">
            Rp {{ number_format($dukun->harga, 0, ',', '.') }} / Hari {{-- <<< UBAH INI --}}
        </div>

        {{-- Spacer agar tombol di bawah --}}
        <div class="flex-grow"></div> 

        <div class="mt-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('catalog.show', $dukun->id) }}" class="flex-1 text-center inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Lihat Detail
                </a>

                <form action="{{ route('cart.store', $dukun) }}" method="POST">
                    @csrf
                    <button type="submit" title="Tambah ke Keranjang" class="p-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>