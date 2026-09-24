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

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Status Verifikasi</dt>
                            <dd>
                                <span class="px-2 py-1 text-xs rounded
                                    @if($mustahik->status_verifikasi == 'terverifikasi') bg-green-100 text-green-700
                                    @elseif($mustahik->status_verifikasi == 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700
                                    @endif">
                                    {{ $mustahik->status_verifikasi ?? 'pending' }}
                                </span>
                            </dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Status</dt>
                            <dd>
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $mustahik->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $mustahik->status }}
                                </span>
                            </dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Total Bantuan Diterima</dt>
                            <dd class="font-semibold text-blue-600">
                                Rp {{ number_format($totalBantuan ?? 0, 0, ',', '.') }}
                            </dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Dibuat</dt>
                            <dd>{{ $mustahik->created_at->format('d M Y H:i') }}</dd>
                        </div>

                    </dl>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('mustahik.edit', $mustahik->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        <a href="{{ route('mustahik.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali ke Daftar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>