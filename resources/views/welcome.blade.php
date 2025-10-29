<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dukunify') }} - Sewa Jasa Dukun Terpercaya</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

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

            @keyframes rotate-slow {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }

            @keyframes flicker {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
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

            .animate-rotate-slow {
                animation: rotate-slow 20s linear infinite;
            }

            .animate-flicker {
                animation: flicker 2s ease-in-out infinite;
            }

            .animate-mystical-pulse {
                animation: mystical-pulse 2s ease-in-out infinite;
            }

            .delay-100 {
                animation-delay: 0.1s;
            }

            .delay-200 {
                animation-delay: 0.2s;
            }

            .delay-300 {
                animation-delay: 0.3s;
            }

            /* Mystical Background Pattern */
            .mystical-bg {
                background-image: 
                    radial-gradient(circle at 20% 50%, rgba(88, 28, 135, 0.4) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(109, 40, 217, 0.3) 0%, transparent 50%),
                    radial-gradient(circle at 40% 20%, rgba(124, 58, 237, 0.3) 0%, transparent 50%);
            }

            /* Mystical Shimmer */
            .mystical-shimmer {
                background: linear-gradient(90deg, transparent, rgba(167, 139, 250, 0.3), transparent);
                background-size: 1000px 100%;
                animation: mystical-shimmer 3s infinite;
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

            /* Hover Scale Effect */
            .hover-mystical {
                transition: all 0.4s ease;
            }

            .hover-mystical:hover {
                transform: translateY(-10px) scale(1.03);
                box-shadow: 
                    0 20px 60px rgba(139, 92, 246, 0.4),
                    0 0 40px rgba(168, 85, 247, 0.3);
            }

            /* Smooth Scroll */
            html {
                scroll-behavior: smooth;
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

            /* Mystical Border Animation */
            @keyframes border-glow {
                0%, 100% {
                    border-color: rgba(139, 92, 246, 0.5);
                }
                50% {
                    border-color: rgba(168, 85, 247, 0.8);
                }
            }

            .border-mystical {
                animation: border-glow 2s ease-in-out infinite;
            }

            /* Moon Phases */
            .moon-phase {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
                box-shadow: 
                    inset -10px -10px 20px rgba(0, 0, 0, 0.2),
                    0 0 30px rgba(255, 255, 255, 0.5);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-b from-gray-900 via-purple-900 to-gray-900 text-gray-100">
        <div class="min-h-screen flex flex-col relative overflow-hidden">
            
            {{-- Stars Background --}}
            <div class="stars fixed inset-0 z-0"></div>
            
            {{-- Mystical Orbs --}}
            <div class="fixed top-20 left-10 w-64 h-64 bg-purple-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-float"></div>
            <div class="fixed bottom-32 right-20 w-96 h-96 bg-violet-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-float" style="animation-delay: 3s;"></div>
            <div class="fixed top-1/2 left-1/3 w-80 h-80 bg-indigo-600 rounded-full mix-blend-screen filter blur-3xl opacity-15 animate-float" style="animation-delay: 5s;"></div>
            
            {{-- Navigasi dengan Glass Effect --}}
            <nav class="glass-dark border-b border-purple-800/30 shadow-lg sticky top-0 z-50 backdrop-blur-xl">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            {{-- Logo dengan Mystical Effect --}}
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('welcome') }}" class="flex items-center group">
                                    <div class="relative">
                                        <x-application-logo class="block h-9 w-auto fill-current text-purple-400 group-hover:text-purple-300 transition-all duration-300 group-hover:scale-110 animate-pulse-glow" />
                                        <div class="absolute inset-0 bg-purple-500 opacity-0 group-hover:opacity-40 blur-xl transition-opacity duration-300"></div>
                                    </div>
                                    <span class="ml-3 font-bold text-xl bg-gradient-to-r from-purple-400 via-violet-400 to-purple-400 bg-clip-text text-transparent group-hover:from-purple-300 group-hover:to-violet-300 transition duration-300 tracking-wider">
                                        {{ config('app.name', 'Dukunify') }}
                                    </span>
                                </a>
                            </div>
                        </div>

                        {{-- Tombol Login/Register dengan Mystical Effect --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-purple-300 hover:text-purple-100 transition duration-300 relative group">
                                        Dashboard
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-purple-400 group-hover:w-full transition-all duration-300 shadow-[0_0_10px_rgba(168,85,247,0.5)]"></span>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-purple-300 hover:text-purple-100 transition duration-300 relative group">
                                        Log in
                                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-purple-400 group-hover:w-full transition-all duration-300 shadow-[0_0_10px_rgba(168,85,247,0.5)]"></span>
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                                            <span class="relative z-10">Register</span>
                                            <div class="absolute inset-0 mystical-shimmer"></div>
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                        
                        {{-- Hamburger Mobile --}}
                         <div class="-me-2 flex items-center sm:hidden space-x-3">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-purple-300 hover:text-purple-100">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm font-medium text-purple-300 hover:text-purple-100">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-violet-600 px-4 py-1.5 rounded-md hover:from-purple-500 hover:to-violet-500 shadow-lg shadow-purple-500/30">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Hero Section dengan Mystical Theme --}}
            <header class="relative mystical-bg text-white shadow-2xl py-24 md:py-36 overflow-hidden">
                {{-- Mystical Symbols (Decorative) --}}
                <div class="absolute top-10 left-10 opacity-20 animate-rotate-slow">
                    <svg class="w-32 h-32 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="0.5"/>
                        <path d="M12 2 L12 22 M2 12 L22 12" stroke-width="0.5"/>
                        <circle cx="12" cy="12" r="6" stroke-width="0.5"/>
                        <circle cx="12" cy="12" r="2" stroke-width="0.5"/>
                    </svg>
                </div>
                <div class="absolute bottom-10 right-10 opacity-20 animate-rotate-slow" style="animation-direction: reverse; animation-duration: 25s;">
                    <svg class="w-40 h-40 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2 L14 10 L22 12 L14 14 L12 22 L10 14 L2 12 L10 10 Z" stroke-width="0.5"/>
                        <circle cx="12" cy="12" r="8" stroke-width="0.5"/>
                    </svg>
                </div>
                
                {{-- Moon Phase Decoration --}}
                <div class="absolute top-20 right-20 moon-phase animate-pulse-glow"></div>
                
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                    <div class="animate-fadeInUp opacity-0">
                        <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold mb-6 leading-tight tracking-wide">
                            Selamat Datang di 
                            <span class="relative inline-block">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-violet-300 to-fuchsia-300 animate-flicker">Dukunify</span>
                                <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 via-violet-400 to-fuchsia-400 rounded-full shadow-[0_0_20px_rgba(168,85,247,0.8)]"></span>
                            </span>
                        </h1>
                        {{-- Mystical Subtitle --}}
                        <div class="flex justify-center gap-2 mb-6 text-purple-300 text-sm tracking-widest">
                            <span>✦</span>
                            <span>Portal Spiritual Terpercaya</span>
                            <span>✦</span>
                        </div>
                    </div>
                    
                    <div class="animate-fadeInUp opacity-0 delay-100">
                        <p class="text-lg md:text-xl text-purple-200 mb-12 max-w-3xl mx-auto leading-relaxed">
                            Platform terpercaya untuk menemukan dan menyewa jasa dukun profesional sesuai kebutuhan spiritual dan metafisika Anda. Dari penerawangan hingga konsultasi, temukan ahlinya di sini.
                        </p>
                    </div>
                    
                    @guest
                    <div class="animate-fadeInUp opacity-0 delay-200">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 text-white font-bold py-4 px-12 rounded-xl shadow-2xl shadow-purple-500/50 hover:shadow-purple-500/70 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 ease-out group relative overflow-hidden border border-purple-400/50 animate-mystical-pulse">
                            <span class="relative z-10 flex items-center gap-2">
                                <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2 L14 10 L22 12 L14 14 L12 22 L10 14 L2 12 L10 10 Z"></path>
                                </svg>
                                Daftar Sekarang Gratis
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-violet-600 to-fuchsia-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                    </div>
                    @endguest
                    
                    {{-- Mystical Ornaments --}}
                    <div class="mt-16 flex justify-center gap-8 opacity-40">
                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse-glow"></div>
                        <div class="w-3 h-3 bg-violet-400 rounded-full animate-pulse-glow delay-100"></div>
                        <div class="w-4 h-4 bg-purple-400 rounded-full animate-pulse-glow delay-200"></div>
                        <div class="w-3 h-3 bg-violet-400 rounded-full animate-pulse-glow delay-100"></div>
                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse-glow"></div>
                    </div>
                </div>
            </header>

            {{-- Stats Section dengan Mystical Glass --}}
            <div class="relative z-20 -mt-16 mb-16">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 p-8 grid grid-cols-1 md:grid-cols-3 gap-8 border border-purple-700/30 mystical-glow">
                        <div class="text-center transform hover:scale-105 transition-transform duration-300 group">
                            <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-purple-400 to-violet-400 mb-2 group-hover:from-purple-300 group-hover:to-violet-300 transition-all">
                                {{ $dukuns->count() }}+
                            </div>
                            <div class="text-purple-300 font-medium tracking-wide">Dukun Terdaftar</div>
                            <div class="text-xs text-purple-400/70 mt-1">✧ Spiritual Expert ✧</div>
                        </div>
                        <div class="text-center transform hover:scale-105 transition-transform duration-300 group">
                            <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-violet-400 to-fuchsia-400 mb-2 group-hover:from-violet-300 group-hover:to-fuchsia-300 transition-all">
                                100%
                            </div>
                            <div class="text-purple-300 font-medium tracking-wide">Terpercaya</div>
                            <div class="text-xs text-purple-400/70 mt-1">✧ Verified Master ✧</div>
                        </div>
                        <div class="text-center transform hover:scale-105 transition-transform duration-300 group">
                            <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-fuchsia-400 to-purple-400 mb-2 group-hover:from-fuchsia-300 group-hover:to-purple-300 transition-all">
                                24/7
                            </div>
                            <div class="text-purple-300 font-medium tracking-wide">Layanan Aktif</div>
                            <div class="text-xs text-purple-400/70 mt-1">✧ Always Ready ✧</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Katalog --}}
            <main class="py-16 md:py-20 flex-grow relative z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <div class="flex justify-center gap-3 mb-4 text-purple-400 animate-pulse-glow">
                            <span class="text-2xl">✧</span>
                            <span class="text-xl">✦</span>
                            <span class="text-2xl">✧</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-100 mb-4 tracking-wide">
                            Katalog Jasa 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-violet-400 to-fuchsia-400">Spiritual Kami</span>
                        </h2>
                        <div class="w-32 h-1 bg-gradient-to-r from-transparent via-purple-500 to-transparent mx-auto rounded-full shadow-[0_0_20px_rgba(168,85,247,0.6)]"></div>
                        <p class="mt-4 text-purple-300 max-w-2xl mx-auto tracking-wide">
                            Pilih dari berbagai layanan spiritual profesional yang tersedia
                        </p>
                    </div>

                    @if ($dukuns->count() > 0)
                        {{-- Grid untuk Dukun Card dengan Mystical Animation --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($dukuns as $index => $dukun)
                                <div class="animate-fadeInUp opacity-0" style="animation-delay: {{ $index * 0.1 }}s;">
                                    <div class="hover-mystical">
                                        <x-dukun-card-guest :dukun="$dukun" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- Tombol Lihat Semua dengan Mystical Effect --}}
                        <div class="mt-16 text-center">
                            <a href="{{ route('user.dashboard') }}" class="inline-flex items-center gap-3 px-8 py-4 glass-dark text-purple-300 font-semibold rounded-xl border-2 border-purple-600/50 hover:border-purple-400 hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-300 transform hover:-translate-y-1 group mystical-glow">
                                <span class="text-base">Lihat Semua Katalog</span>
                                <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                                <span class="text-xs text-purple-400 bg-purple-900/50 px-3 py-1 rounded-full border border-purple-500/30">Perlu Login</span>
                            </a>
                        </div>

                    @else
                        {{-- Pesan jika Dukun tidak ditemukan --}}
                         <div class="glass-dark border-2 border-dashed border-purple-600/30 rounded-2xl shadow-lg shadow-purple-900/30">
                            <div class="p-12 text-center">
                                <svg class="w-20 h-20 text-purple-400/50 mx-auto mb-4 animate-pulse-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <h3 class="text-xl font-semibold text-purple-300 mb-2">Katalog Masih Kosong</h3>
                                <p class="text-purple-400/70">Saat ini belum ada Dukun yang tersedia di katalog kami. Silakan cek kembali nanti.</p>
                            </div>
                         </div>
                    @endif
                </div>
            </main>

            {{-- Footer dengan Mystical Theme --}}
            <footer class="relative glass-dark border-t border-purple-800/30 text-purple-300 py-12 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-96 h-96 bg-purple-600 rounded-full filter blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-violet-600 rounded-full filter blur-3xl"></div>
                </div>
                
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center">
                        <div class="mb-6">
                            <span class="font-bold text-2xl bg-gradient-to-r from-purple-400 via-violet-400 to-purple-400 bg-clip-text text-transparent tracking-wider animate-pulse-glow">
                                {{ config('app.name', 'Dukunify') }}
                            </span>
                            <div class="text-xs text-purple-400/70 mt-2 tracking-widest">✧ Portal Spiritual Nusantara ✧</div>
                        </div>
                        
                        <div class="flex justify-center gap-6 mb-6">
                            <a href="#" class="w-10 h-10 glass-dark border border-purple-600/30 hover:border-purple-400 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-purple-500/30 group">
                                <svg class="w-5 h-5 text-purple-400 group-hover:text-purple-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 glass-dark border border-purple-600/30 hover:border-purple-400 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-purple-500/30 group">
                                <svg class="w-5 h-5 text-purple-400 group-hover:text-purple-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 glass-dark border border-purple-600/30 hover:border-purple-400 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-purple-500/30 group">
                                <svg class="w-5 h-5 text-purple-400 group-hover:text-purple-300" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        </div>
                        
                        {{-- Mystical Divider --}}
                        <div class="flex justify-center gap-2 mb-6 text-purple-500/50">
                            <span class="text-xs">✧</span>
                            <span class="text-xs">✦</span>
                            <span class="text-xs">✧</span>
                        </div>
                        
                        <div class="text-sm space-y-2">
                            <p class="text-purple-400">&copy; {{ date('Y') }} {{ config('app.name', 'Dukunify') }}. All rights reserved.</p>
                            <p class="flex items-center justify-center gap-2 text-purple-300">
                                Dibuat dengan 
                                <span class="text-red-400 animate-pulse text-xl">♥</span> 
                                di Bandung
                            </p>
                            <p class="text-xs text-purple-500/70 italic">
                                "Menghubungkan Dunia Material dengan Spiritual"
                            </p>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        
        {{-- Script untuk Animasi on Scroll --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.animate-fadeInUp').forEach(el => {
                    observer.observe(el);
                });
            });
        </script>
        
        @stack('scripts')
    </body>
</html>