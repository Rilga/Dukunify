@props(['active'])

@php
// MODIFIKASI: Mengganti class 'active' dan 'inactive'
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-purple-400 text-sm font-medium leading-5 text-white focus:outline-none focus:border-purple-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-purple-300 hover:text-purple-100 hover:border-purple-400 focus:outline-none focus:text-purple-100 focus:border-purple-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>