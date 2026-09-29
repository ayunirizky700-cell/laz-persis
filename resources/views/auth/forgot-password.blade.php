<x-guest-layout>
    <div class="min-h-screen flex">

        {{-- LEFT: BRANDING --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/10 rounded-full -ml-40 -mb-40"></div>

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">LAZ PERSIS</h1>
                        <p class="text-sm text-blue-100">Sistem Manajemen Zakat</p>
                    </div>
                </div>

                <h2 class="text-4xl font-bold leading-tight mb-4">
                    Lupa<br>
                    <span class="text-yellow-300">Password?</span>
                </h2>
                <p class="text-blue-100 text-lg mb-8 leading-relaxed">
                    Jangan khawatir. Masukkan email Anda, kami akan mengirimkan link untuk reset password.
                </p>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold mb-1">Tips:</p>
                            <p class="text-sm text-blue-100">Link reset password akan dikirim ke email Anda dalam
                                beberapa menit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: FORM --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-gray-50">
            <div class="w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center justify-center gap-3 mb-8">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">LAZ PERSIS</h1>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Reset Password 🔑</h2>
                    <p class="text-gray-500">Masukkan email Anda untuk reset password</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div
                            class="flex items-center border border-gray-300 rounded-xl bg-white px-3 py-1 focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-all">
                            <svg class="h-5 w-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="email@example.com"
                                class="w-full py-3 bg-transparent border-0 focus:ring-0 focus:outline-none text-gray-800 placeholder-gray-400">
                        </div>
                        @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 
                        text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 
                        shadow-lg shadow-blue-200 hover:shadow-xl flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        KIRIM LINK RESET
                    </button>

                    {{-- Back to Login --}}
                    <p class="mt-6 text-center text-sm text-gray-600">
                        Ingat password?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Kembali ke Login
                        </a>
                    </p>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500">
                    © {{ date('Y') }} LAZ PERSIS
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>