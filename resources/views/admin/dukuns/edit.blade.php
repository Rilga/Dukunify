<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Edit Dukun: ') . $dukun->nama_dukun }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Utama (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    
                    {{-- Tampilkan Error Validasi (Dark Mode) --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-800/50 border border-red-600/50 text-red-300 rounded-lg shadow-lg shadow-red-900/50">
                            <p class="font-bold">Oops! Ada beberapa kesalahan:</p>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.dukuns.update', $dukun->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Kode Dukun (Dark Mode Input) --}}
                        <div>
                            <label for="kode_dukun" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Kode Dukun (Unik)') }}</label>
                            <input id="kode_dukun" type="text" name="kode_dukun" value="{{ old('kode_dukun', $dukun->kode_dukun) }}" required autofocus
                                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            <x-input-error :messages="$errors->get('kode_dukun')" class="mt-2" />
                        </div>

                        {{-- Nama Dukun (Dark Mode Input) --}}
                        <div class="mt-4">
                            <label for="nama_dukun" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Nama Dukun') }}</label>
                            <input id="nama_dukun" type="text" name="nama_dukun" value="{{ old('nama_dukun', $dukun->nama_dukun) }}" required
                                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            <x-input-error :messages="$errors->get('nama_dukun')" class="mt-2" />
                        </div>

                        {{-- Harga (Dark Mode Input) --}}
                        <div class="mt-4">
                            <label for="harga" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Harga (Rp)') }}</label>
                            <input id="harga" type="number" name="harga" value="{{ old('harga', $dukun->harga) }}" required
                                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        {{-- Kategori (Dark Mode Checkbox) --}}
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-purple-300 mb-1">{{ __('Kategori (Bisa pilih lebih dari 1)') }}</label>
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-4 p-4 bg-gray-900/50 border-purple-700/50 border rounded-lg">
                                @foreach ($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                               class="bg-gray-900/50 border-purple-700/50 text-purple-500 focus:ring-purple-600 focus:ring-offset-gray-900 rounded shadow-sm"
                                               {{-- Cek apakah kategori ini ada di 'old' ATAU di data $dukunCategoryIds --}}
                                               @if(is_array(old('categories')) && in_array($category->id, old('categories')))
                                                   checked
                                               @elseif(!is_array(old('categories')) && in_array($category->id, $dukunCategoryIds))
                                                   checked
                                               @endif
                                        >
                                        <span class="ml-2 text-sm text-purple-300">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                        </div>

                        {{-- Gambar Dukun (Dark Mode File Input) --}}
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Ganti Gambar Dukun (Opsional)') }}</label>
                            <input id="image" type="file" name="image"
                                   class="block w-full text-sm text-purple-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-600/50 file:text-purple-100 hover:file:bg-purple-700/50 border border-purple-700/50 rounded-lg p-1.5 bg-gray-900/50 shadow-sm cursor-pointer">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                            @if ($dukun->image)
                                <div class="mt-4">
                                    <label class="block font-medium text-sm text-purple-300 mb-1">{{ __('Gambar Saat Ini') }}</label>
                                    <img src="{{ Storage::url($dukun->image) }}" alt="{{ $dukun->nama_dukun }}" class="w-32 h-32 object-cover rounded-lg shadow-lg border border-purple-700/50">
                                </div>
                            @endif
                        </div>

                        {{-- Deskripsi (Dark Mode Textarea) --}}
                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Deskripsi (Opsional)') }}</label>
                            <textarea id="description" name="description" rows="4" 
                                      class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">{{ old('description', $dukun->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            {{-- Tombol Batal (Themed) --}}
                            <a href="{{ route('admin.dukuns.index') }}" 
                               class="px-4 py-2 text-sm text-purple-300 rounded-lg hover:bg-purple-800/50 transition duration-300 mr-4">
                                {{ __('Batal') }}
                            </a>
                            
                            {{-- Tombol Simpan (Mystical) --}}
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                                <span class="relative z-10">{{ __('Update') }}</span>
                                <div class="absolute inset-0 mystical-shimmer"></div>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>