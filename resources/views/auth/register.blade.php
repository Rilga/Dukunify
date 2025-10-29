<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-purple-300 mb-1">
                {{ __('Nama') }}
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-purple-300 mb-1">
                {{ __('Email') }}
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-purple-300 mb-1">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-purple-300 mb-1">
                {{ __('Konfirmasi Password') }}
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            {{-- Tombol Register dengan Efek Mistis --}}
            <button type="submit"
                    class="w-full inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                <span class="relative z-10">{{ __('Register') }}</span>
                <div class="absolute inset-0 mystical-shimmer"></div>
            </button>
        </div>
        
        <!-- Link ke Login -->
        <div class="text-center mt-8">
            <p class="text-sm text-purple-300">
                {{ __("Sudah punya akun?") }}
                <a href="{{ route('login') }}"
                   class="font-medium text-purple-400 hover:text-purple-200 underline transition duration-300 relative group">
                   Login di sini
                   <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-purple-400 group-hover:w-full transition-all duration-300"></span>
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>