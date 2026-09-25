<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Mustahik') }} - {{ $mustahik->kode }}
            </h2>
            <a href="{{ route('mustahik.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="divide-y divide-gray-200">

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Kode</dt>
                            <dd class="font-mono">{{ $mustahik->kode }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Nama</dt>
                            <dd>{{ $mustahik->nama }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Alamat</dt>
                            <dd>{{ $mustahik->alamat ?? '-' }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">No. Telepon</dt>
                            <dd>{{ $mustahik->no_telepon ?? '-' }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Kategori Asnaf</dt>
                            <dd class="capitalize">{{ $mustahik->kategori_asnaf }}</dd>
                        </div>

                        {{-- Blok Verifikasi --}}
                        @if($mustahik->status_verifikasi === 'pending')
                            <div class="mt-6 pt-6 border-t">
                                <p class="font-semibold text-gray-800 mb-3">Verifikasi Mustahik:</p>
                                <div class="flex gap-2">
                                    <form action="{{ route('mustahik.verifikasi', $mustahik) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <input type="hidden" name="status_verifikasi" value="terverifikasi">
                                        <button
                                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">
                                            ✓ Verifikasi
                                        </button>
                                    </form>
                                    <form action="{{ route('mustahik.verifikasi', $mustahik) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <input type="hidden" name="status_verifikasi" value="ditolak">
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold">
                                            ✗ Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        {{-- Tombol Kembali --}}
                        <div class="mt-6">
                            <a href="{{ route('mustahik.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>