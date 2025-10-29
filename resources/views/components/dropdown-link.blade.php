@props(['active'])

@php
// MODIFIKASI: Mengganti warna teks dan latar belakang hover/focus
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 text-start text-sm leading-5 text-white bg-purple-900/50 focus:outline-none focus:bg-purple-900/70 transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 text-start text-sm leading-5 text-purple-300 hover:bg-purple-900/50 focus:outline-none focus:bg-purple-900/50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>