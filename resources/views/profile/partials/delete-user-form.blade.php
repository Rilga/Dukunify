<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-bold text-purple-100">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-purple-300">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus, harap unduh data apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    {{-- Tombol Hapus Akun (Merah) dengan Efek Mistis --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-red-600 via-rose-600 to-red-600 rounded-lg hover:from-red-500 hover:to-rose-500 transition-all duration-300 shadow-lg hover:shadow-red-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-red-400/30"
    >
        <span class="relative z-10">{{ __('Hapus Akun') }}</span>
        <div class="absolute inset-0 mystical-shimmer" style="background: linear-gradient(90deg, transparent, rgba(255, 150, 150, 0.3), transparent);"></div>
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        {{-- Kita beri style glass-dark pada form di dalam modal --}}
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 glass-dark rounded-lg border border-purple-700/30">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-purple-100">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-1 text-sm text-purple-300">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus permanen. Masukkan password Anda untuk mengonfirmasi penghapusan permanen.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block mt-1 w-3/4 bg-gray-900/50 border-purple-700/50 border focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-100 placeholder-gray-500"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                {{-- Tombol Batal --}}
                <button type="button" x-on:click="$dispatch('close')" 
                        class="px-4 py-2 bg-transparent border border-purple-600/50 text-purple-300 rounded-lg hover:bg-purple-800/50 transition duration-300">
                    {{ __('Batal') }}
                </button>

                {{-- Tombol Hapus (Merah) --}}
                <button type="submit"
                        class="ms-3 inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-gradient-to-r from-red-600 via-rose-600 to-red-600 rounded-lg hover:from-red-500 hover:to-rose-500 transition-all duration-300 shadow-lg hover:shadow-red-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-red-400/30">
                    <span class="relative z-10">{{ __('Hapus Akun') }}</span>
                </button>
            </div>
        </form>
    </x-modal>
</section>