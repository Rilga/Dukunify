<x-app-layout>
    {{-- Kita ubah header agar teksnya putih/terang --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-100 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Mengganti card putih dengan card glass-dark --}}
            <div class="p-4 sm:p-8 glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Mengganti card putih dengan card glass-dark --}}
            <div class="p-4 sm:p-8 glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Mengganti card putih dengan card glass-dark --}}
            <div class="p-4 sm:p-8 glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>