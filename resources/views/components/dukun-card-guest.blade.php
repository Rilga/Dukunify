@props(['dukun'])

<div class="glass-dark overflow-hidden shadow-lg shadow-purple-900/50 sm:rounded-2xl flex flex-col"> 
    
    {{-- Gambar Dukun --}}
    <div class="h-48 w-full bg-gray-800 flex-shrink-0"> {{-- Latar belakang placeholder digelapkan --}}
        @if ($dukun->image)
            <img src="{{ Storage::url($dukun->image) }}" alt="{{ $dukun->nama_dukun }}" class="h-full w-full object-cover">
        @else
            <div class="h-full w-full flex items-center justify-center">
                {{-- MODIFIKASI: Warna SVG diubah ke ungu tematik --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-400/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        @endif
    </div>
    {{-- Akhir Gambar --}}

    <div class="p-6 flex flex-col flex-grow"> 
        {{-- Kategori --}}
        <div class="mb-2">
            @forelse ($dukun->categories as $category)
                {{-- MODIFIKASI: Mengubah style badge agar sesuai tema dark/purple --}}
                <span class="inline-block bg-purple-500/20 text-purple-300 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full border border-purple-500/30">
                    {{ $category->name }}
                </span>
            @empty
                {{-- MODIFIKASI: Mengubah style badge 'empty' agar sesuai tema dark --}}
                <span class="inline-block bg-gray-700/30 text-gray-400 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full border border-gray-600/30">
                    Tanpa Kategori
                </span>
            @endforelse
        </div>

        {{-- Kode Dukun --}}
        {{-- MODIFIKASI: Mengubah 'text-gray-500' menjadi 'text-purple-400/70' --}}
        <div class="text-xs font-semibold text-purple-400/70 uppercase tracking-wide">
            {{ $dukun->kode_dukun }}
        </div>

        {{-- Nama Dukun --}}
        {{-- MODIFIKASI: Mengubah 'text-gray-900' menjadi 'text-gray-100' --}}
        <h3 class="mt-1 text-xl font-bold text-gray-100 truncate">
            {{ $dukun->nama_dukun }}
        </h3>

        {{-- Harga --}}
        {{-- MODIFIKASI: Mengubah 'text-indigo-600' menjadi teks gradien mistis --}}
        <div class="mt-2 text-lg font-bold text-purple-300">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-violet-400 to-fuchsia-400">
                Rp {{ number_format($dukun->harga, 0, ',', '.') }}
            </span> 
            <span class="text-sm text-purple-400/80">/ Hari</span>
        </div>

        {{-- Spacer --}}
        <div class="flex-grow"></div> 

        <div class="mt-4">
            <a href="{{ route('login') }}" 
               class="w-full text-center inline-flex items-center justify-center px-4 py-2 bg-purple-500/10 border border-purple-600/50 rounded-lg font-semibold text-xs text-purple-300 uppercase tracking-widest hover:bg-purple-500/30 hover:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:ring-offset-2 focus:ring-offset-gray-900 disabled:opacity-25 transition ease-in-out duration-150">
                Login untuk Menyewa
            </a>
        </div>
    </div>
</div>