<x-app-layout>
    {{-- Header dengan teks terang dan tombol mistis --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-purple-100 leading-tight">
                {{ __('Manajemen Klien (User)') }}
            </h2>
            
            {{-- Tombol Tambah Klien (Mystical) --}}
            <a href="{{ route('admin.users.create') }}" 
               class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 via-violet-600 to-purple-600 rounded-lg hover:from-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-0.5 relative overflow-hidden group border border-purple-400/30 animate-mystical-pulse">
                <span class="relative z-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                    <span>Tambah Klien</span>
                </span>
                <div class="absolute inset-0 mystical-shimmer"></div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Utama (Glassmorphism) --}}
            <div class="glass-dark rounded-2xl shadow-2xl shadow-purple-900/50 border border-purple-700/30 mystical-glow overflow-hidden">
                <div class="p-6 sm:p-8 text-purple-100">
                    
                    {{-- Notifikasi Sukses (Dark Mode) --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-800/50 border border-green-600/50 text-green-300 rounded-lg shadow-lg shadow-green-900/50">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Wrapper untuk tabel agar bisa scroll di mobile --}}
                    <div class="overflow-x-auto rounded-lg border border-purple-800/30">
                        <table class="min-w-full divide-y divide-purple-900/50">
                            {{-- Header Tabel (Dark Mode) --}}
                            <thead class="bg-gray-900/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-purple-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            {{-- Body Tabel (Dark Mode) --}}
                            <tbody class="divide-y divide-purple-800/30">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-900/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-200">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-300">
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->role == 'admin' ? 'bg-red-800/50 text-red-300 border border-red-700/50' : 'bg-green-800/50 text-green-300 border border-green-700/50' }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-purple-400 hover:text-purple-200 transition duration-300">Edit</a>

                                            @if (Auth::id() !== $user->id)
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 ml-4 transition duration-300">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-purple-400 text-center">Belum ada data user.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (dengan style kustom) --}}
                    <div class="mt-6 mystical-pagination">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Style Kustom untuk Pagination Tailwind di Tema Gelap --}}
    <style>
        .mystical-pagination nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .mystical-pagination .hidden {
            display: none;
        }
        .mystical-pagination p {
            color: #c4b5fd; /* purple-300 */
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        .mystical-pagination a, .mystical-pagination span {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
            background: rgba(17, 24, 39, 0.7); /* glass-dark bg */
            border: 1px solid rgba(139, 92, 246, 0.3); /* glass-dark border */
            color: #c4b5fd; /* purple-300 */
            transition: all 0.3s;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        .mystical-pagination a:hover {
            background: rgba(139, 92, 246, 0.2);
            color: #ddd6fe; /* purple-200 */
        }
        .mystical-pagination .cursor-default span {
            opacity: 0.5;
            background: rgba(17, 24, 39, 0.4);
        }
        /* Current page */
        .mystical-pagination .cursor-default span[aria-current="page"] {
            opacity: 1;
            background: rgba(139, 92, 246, 0.3);
            font-weight: 600;
            color: #ede9fe; /* violet-100 */
        }
        /* Mobile small buttons */
        .mystical-pagination .px-4.py-2, .mystical-pagination .relative.inline-flex {
            padding: 0.5rem 1rem;
        }
    </style>
</x-app-layout>