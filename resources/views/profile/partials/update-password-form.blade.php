<section>
    <header>
        <h2 class="text-2xl font-bold text-purple-100">
            {{ __('Ubah Password') }}
        </h2>

        <p class="mt-1 text-sm text-purple-300">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Password Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Password Baru') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-purple-300 mb-1">{{ __('Konfirmasi Password Baru') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   class="block mt-1 w-full bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            {{-- Tombol Save dengan Efek Mistis --}}
            <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                <span class="relative z-10">{{ __('Simpan') }}</span>
                <div class="absolute inset-0 mystical-shimmer"></div>
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>