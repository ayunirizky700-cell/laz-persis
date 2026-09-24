<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Muzakki') }} - {{ $muzakki->kode }}
            </h2>
            <a href="{{ route('muzakki.index') }}"
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
                            <dd class="font-mono">{{ $muzakki->kode }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Nama</dt>
                            <dd>{{ $muzakki->nama }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">No. Telepon</dt>
                            <dd>{{ $muzakki->no_telepon ?? '-' }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Email</dt>
                            <dd>{{ $muzakki->email ?? '-' }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Alamat</dt>
                            <dd>{{ $muzakki->alamat ?? '-' }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Kategori</dt>
                            <dd class="capitalize">{{ $muzakki->kategori }}</dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Status</dt>
                            <dd>
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $muzakki->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $muzakki->status }}
                                </span>
                            </dd>
                        </div>

                        <div class="py-3 flex justify-between">
                            <dt class="font-medium text-gray-600">Dibuat</dt>
                            <dd>{{ $muzakki->created_at->format('d M Y H:i') }}</dd>
                        </div>

                    </dl>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('muzakki.edit', $muzakki->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        <a href="{{ route('muzakki.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali ke Daftar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>