<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-purple-300 bg-purple-900/50 border border-purple-700/50 p-4 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-purple-300 mb-1">
                {{ __('Email') }}
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-purple-300 mb-1">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-purple-700 bg-gray-900/50 text-purple-600 shadow-sm focus:ring-purple-500 focus:ring-offset-gray-900">
                <span class="ms-2 text-sm text-purple-300">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-purple-400 hover:text-purple-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 focus:ring-offset-gray-900"
                   href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            {{-- Tombol Login dengan Efek Mistis --}}
            <button type="submit"
                    class="ms-3 inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                <span class="relative z-10">{{ __('Log in') }}</span>
                <div class="absolute inset-0 mystical-shimmer"></div>
            </button>
        </div>
        
        <!-- Link ke Register -->
        <div class="text-center mt-8">
            <p class="text-sm text-purple-300">
                {{ __("Belum punya akun?") }}
                <a href="{{ route('register') }}"
                   class="font-medium text-purple-400 hover:text-purple-200 underline transition duration-300 relative group">
                   Daftar di sini
                   <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-purple-400 group-hover:w-full transition-all duration-300"></span>
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>