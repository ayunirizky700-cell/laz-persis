<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">Profil Saya</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ============ HERO PROFILE BANNER ============ --}}
            <div
                class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 rounded-3xl shadow-2xl overflow-hidden mb-8">
                {{-- Decorative Circles --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-white/5 rounded-full"></div>

                <div class="relative p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

                        {{-- Avatar --}}
                        <div class="relative">
                            <div
                                class="w-32 h-32 rounded-full bg-white shadow-2xl flex items-center justify-center border-4 border-white/50">
                                <span
                                    class="text-5xl font-bold bg-gradient-to-br from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ strtoupper(substr(Auth::user()->nama ?? Auth::user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <div
                                class="absolute bottom-1 right-1 w-8 h-8 rounded-full bg-green-400 border-4 border-white flex items-center justify-center">
                                <div class="w-2 h-2 rounded-full bg-white"></div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 text-center md:text-left text-white">
                            <h3 class="text-3xl md:text-4xl font-bold">
                                {{ Auth::user()->nama ?? Auth::user()->name }}
                            </h3>
                            <p class="mt-2 text-white/80 text-lg">{{ Auth::user()->email }}</p>

                            <div class="mt-4 flex flex-wrap gap-2 justify-center md:justify-start">
                                <span
                                    class="bg-white/20 backdrop-blur-sm px-4 py-1.5 rounded-full text-sm font-semibold">
                                    🎯 {{ Auth::user()->role->nama_role ?? 'User' }}
                                </span>
                                <span class="bg-green-400/90 text-green-900 px-4 py-1.5 rounded-full text-sm font-bold">
                                    ● {{ ucfirst(Auth::user()->status ?? 'aktif') }}
                                </span>
                            </div>
                        </div>

                        {{-- Quick Stats --}}
                        <div class="flex gap-3 text-white">
                            <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-4 text-center min-w-[100px]">
                                <p class="text-3xl font-bold">1</p>
                                <p class="text-xs opacity-80 mt-1">Akun</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ STAT CARDS ============ --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-5 border-l-4 border-indigo-500">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Role</p>
                            <p class="text-lg font-bold text-gray-800">{{ Auth::user()->role->nama_role ?? 'User' }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-5 border-l-4 border-green-500">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Bergabung</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ Auth::user()->created_at?->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-5 border-l-4 border-yellow-500">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Terakhir Login</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ Auth::user()->last_login ? Auth::user()->last_login->format('d M Y') : 'Baru Saja' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ FORM SECTION ============ --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Update Profil --}}
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                        <div class="flex items-center gap-3 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div>
                                <h3 class="font-bold text-lg">Informasi Profil</h3>
                                <p class="text-xs opacity-90">Perbarui nama dan email Anda</p>
                            </div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="text-blue-600">●</span> Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="w-full border-gray-300 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="text-blue-600">●</span> Alamat Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="w-full border-gray-300 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-lg shadow-blue-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span class="text-sm text-green-600 font-medium animate-pulse">✓ Tersimpan</span>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Update Password --}}
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4">
                        <div class="flex items-center gap-3 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <div>
                                <h3 class="font-bold text-lg">Ubah Password</h3>
                                <p class="text-xs opacity-90">Gunakan password yang kuat</p>
                            </div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="p-6 space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="text-yellow-600">●</span> Password Saat Ini
                            </label>
                            <input type="password" name="current_password"
                                class="w-full border-gray-300 rounded-xl px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all">
                            @error('current_password', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="text-yellow-600">●</span> Password Baru
                            </label>
                            <input type="password" name="password"
                                class="w-full border-gray-300 rounded-xl px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all">
                            @error('password', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="text-yellow-600">●</span> Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                class="w-full border-gray-300 rounded-xl px-4 py-3 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all">
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit"
                                class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-lg shadow-yellow-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                    </path>
                                </svg>
                                Ubah Password
                            </button>
                            @if (session('status') === 'password-updated')
                                <span class="text-sm text-green-600 font-medium animate-pulse">✓ Password diubah</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- ============ DANGER ZONE ============ --}}
            <div class="mt-6 bg-white rounded-2xl shadow-md overflow-hidden border-2 border-red-200">
                <div class="bg-gradient-to-r from-red-500 to-pink-600 px-6 py-4">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="font-bold text-lg">Zona Bahaya</h3>
                            <p class="text-xs opacity-90">Tindakan yang tidak bisa dibatalkan</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Hapus Akun</h4>
                        <p class="text-sm text-gray-600 mt-1">
                            Setelah dihapus, semua data Anda akan hilang permanen.
                        </p>
                    </div>
                    <button type="button" onclick="document.getElementById('confirmDelete').showModal()"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-lg shadow-red-200 flex items-center gap-2 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus Akun
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ============ MODAL KONFIRMASI HAPUS ============ --}}
    <dialog id="confirmDelete" class="rounded-2xl p-0 backdrop:bg-black/60 backdrop:backdrop-blur-sm max-w-md w-full">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Yakin hapus akun?</h3>
                    <p class="text-sm text-gray-500">Tindakan ini permanen</p>
                </div>
            </div>

            <p class="text-sm text-gray-600 mb-4">
                Masukkan password Anda untuk konfirmasi:
            </p>

            <input type="password" name="password" placeholder="Password Anda"
                class="w-full border-gray-300 rounded-xl px-4 py-3 mb-3 focus:border-red-500 focus:ring-2 focus:ring-red-200">
            @error('password', 'userDeletion')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <div class="flex gap-2 justify-end pt-2">
                <button type="button" onclick="document.getElementById('confirmDelete').close()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2.5 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </dialog>
</x-app-layout>