<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dukunify') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Custom Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(5deg);
                }
            }
            @keyframes pulse-glow {
                0%, 100% {
                    opacity: 0.5;
                    transform: scale(1);
                }
                50% {
                    opacity: 1;
                    transform: scale(1.1);
                }
            }
            @keyframes mystical-shimmer {
                0% {
                    background-position: -1000px 0;
                }
                100% {
                    background-position: 1000px 0;
                }
            }
            @keyframes mystical-pulse {
                0%, 100% {
                    box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
                }
                50% {
                    box-shadow: 0 0 40px rgba(139, 92, 246, 0.6), 0 0 60px rgba(168, 85, 247, 0.4);
                }
            }
            .animate-fadeInUp {
                animation: fadeInUp 0.8s ease-out forwards;
            }
            .animate-float {
                animation: float 8s ease-in-out infinite;
            }
            .animate-pulse-glow {
                animation: pulse-glow 3s ease-in-out infinite;
            }
            .animate-mystical-pulse {
                animation: mystical-pulse 2s ease-in-out infinite;
            }

            /* Glassmorphism Dark Card */
            .glass-dark {
                background: rgba(17, 24, 39, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(139, 92, 246, 0.3);
            }

            /* Mystical Glow Effect */
            .mystical-glow {
                box-shadow: 
                    0 0 20px rgba(139, 92, 246, 0.3),
                    inset 0 0 20px rgba(139, 92, 246, 0.1);
            }

            /* Stars Background */
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
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-b from-gray-900 via-purple-900 to-gray-900 text-gray-100">
        {{-- Latar Belakang Mistis --}}
        <div class="stars fixed inset-0 z-0"></div>
        <div class="fixed top-20 left-10 w-64 h-64 bg-purple-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-float z-0"></div>
        <div class="fixed bottom-32 right-20 w-96 h-96 bg-violet-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-float z-0" style="animation-delay: 3s;"></div>
        
        {{-- Konten Halaman (Login/Register) --}}
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            
            {{-- Logo --}}
            <div>
                <a href="/" class="flex items-center group mb-6">
                    <div class="relative">
                        <x-application-logo class="block h-12 w-auto fill-current text-purple-400 group-hover:text-purple-300 transition-all duration-300 group-hover:scale-110 animate-pulse-glow" />
                        <div class="absolute inset-0 bg-purple-500 opacity-0 group-hover:opacity-40 blur-xl transition-opacity duration-300"></div>
                    </div>
                    <span class="ml-3 font-bold text-2xl bg-gradient-to-r from-purple-400 via-violet-400 to-purple-400 bg-clip-text text-transparent group-hover:from-purple-300 group-hover:to-violet-300 transition duration-300 tracking-wider">
                        {{ config('app.name', 'Dukunify') }}
                    </span>
                </a>
            </div>

            {{-- Card Kaca tempat Form --}}
            <div class="w-full sm:max-w-md mt-6 px-8 py-10 glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow animate-fadeInUp opacity-0">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
