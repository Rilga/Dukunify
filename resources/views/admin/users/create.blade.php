<x-app-layout>
    {{-- Header dengan teks terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Tambah Klien (User) Baru') }}
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

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        {{-- Nama Lengkap (Dark Mode Input) --}}
                        <div>
                            <label for="name" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Nama Lengkap') }}</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email (Dark Mode Input) --}}
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Email') }}</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password (Dark Mode Input) --}}
                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" required
                                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Role (Dark Mode Select) --}}
                        <div class="mt-4">
                            <label for="role" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Role') }}</label>
                            <select id="role" name="role" style="color-scheme: dark;"
                                    class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }} class="bg-gray-900 text-purple-200">User (Klien)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }} class="bg-gray-900 text-purple-200">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            {{-- Tombol Batal (Themed) --}}
                            <a href="{{ route('admin.users.index') }}" 
                               class="px-4 py-2 text-sm text-purple-300 rounded-lg hover:bg-purple-800/50 transition duration-300 mr-4">
                                {{ __('Batal') }}
                            </a>
                            
                            {{-- Tombol Simpan (Mystical) --}}
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                                <span class="relative z-10">{{ __('Simpan') }}</span>
                                <div class="absolute inset-0 mystical-shimmer"></div>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
