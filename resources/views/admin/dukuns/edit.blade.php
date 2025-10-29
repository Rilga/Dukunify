<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dukun: ') . $dukun->nama_dukun }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.dukuns.update', $dukun->id) }}" method="POST" enctype="multipart/form-data"> {{-- <<< Tambahkan enctype --}}
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <x-input-label for="kode_dukun" :value="__('Kode Dukun (Unik)')" />
                            <x-text-input id="kode_dukun" class="block mt-1 w-full" type="text" name="kode_dukun" :value="old('kode_dukun', $dukun->kode_dukun)" required autofocus />
                            <x-input-error :messages="$errors->get('kode_dukun')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="nama_dukun" :value="__('Nama Dukun')" />
                            <x-text-input id="nama_dukun" class="block mt-1 w-full" type="text" name="nama_dukun" :value="old('nama_dukun', $dukun->nama_dukun)" required />
                            <x-input-error :messages="$errors->get('nama_dukun')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="harga" :value="__('Harga (Rp)')" />
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga', $dukun->harga)" required />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label :value="__('Kategori (Bisa pilih lebih dari 1)')" />
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                               {{-- Cek apakah kategori ini ada di 'old' ATAU di data $dukunCategoryIds --}}
                                               @if(is_array(old('categories')) && in_array($category->id, old('categories')))
                                                   checked
                                               @elseif(!is_array(old('categories')) && in_array($category->id, $dukunCategoryIds))
                                                   checked
                                               @endif
                                        >
                                        <span class="ml-2 text-sm text-gray-600">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Ganti Gambar Dukun (Opsional)')" />
                            <x-text-input id="image" class="block mt-1 w-full border border-gray-300 p-2 rounded" type="file" name="image" /> {{-- <<< Style border ditambahkan manual --}}
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                            @if ($dukun->image)
                                <div class="mt-4">
                                    <x-input-label :value="__('Gambar Saat Ini')" />
                                    <img src="{{ Storage::url($dukun->image) }}" alt="{{ $dukun->nama_dukun }}" class="w-32 h-32 object-cover rounded-md shadow-sm">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi (Opsional)')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $dukun->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.dukuns.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>