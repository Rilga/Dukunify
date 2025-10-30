<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dukunify') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .glass-dark {
                background: rgba(17, 24, 39, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(139, 92, 246, 0.3);
            }
            .stars {
                background-image: 
                    radial-gradient(2px 2px at 20px 30px, #eee, transparent),
                    radial-gradient(2px 2px at 60px 70px, #fff, transparent),
                    radial-gradient(1px 1px at 50px 50px, #ddd, transparent),
                    radial-gradient(1px 1px at 130px 80px, #fff, transparent),
                    radial-gradient(2px 2px at 90px 10px, #eee, transparent);
                background-repeat: repeat;
                background-size: 200px 200px;
                opacity: 0.3;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(5deg);
                }
            }
            
            .animate-float {
                animation: float 8s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-b from-gray-900 via-purple-900 to-gray-900 text-gray-100">
        <div class="min-h-screen relative overflow-hidden">
            
            <div class="stars fixed inset-0 z-0"></div>
            <div class="fixed top-20 left-10 w-64 h-64 bg-purple-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-float z-0"></div>
            <div class="fixed bottom-32 right-20 w-96 h-96 bg-violet-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-float z-0" style="animation-delay: 3s;"></div>
            
            <div class="relative z-10">
                @include('layouts.navigation')

                @isset($header)
                    <header class="shadow-lg border-b border-purple-800/20">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
            
            @stack('scripts')
        </div>
    </body>
</html>