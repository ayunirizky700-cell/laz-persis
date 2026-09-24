<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mustahik') }} - {{ $mustahik->kode }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mustahik.update', $mustahik->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" value="{{ old('nama', $mustahik->nama) }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" rows="3" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('alamat', $mustahik->alamat) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $mustahik->no_telepon) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Kategori Asnaf <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori_asnaf" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="">-- Pilih Asnaf --</option>
                                <option value="fakir" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'fakir' ? 'selected' : '' }}>Fakir</option>
                                <option value="miskin" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'miskin' ? 'selected' : '' }}>Miskin</option>
                                <option value="amil" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'amil' ? 'selected' : '' }}>Amil</option>
                                <option value="muallaf" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'muallaf' ? 'selected' : '' }}>Muallaf</option>
                                <option value="riqab" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'riqab' ? 'selected' : '' }}>Riqab</option>
                                <option value="gharim" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'gharim' ? 'selected' : '' }}>Gharim</option>
                                <option value="fisabilillah" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'fisabilillah' ? 'selected' : '' }}>Fisabilillah</option>
                                <option value="ibnu_sabil" {{ old('kategori_asnaf', $mustahik->kategori_asnaf) == 'ibnu_sabil' ? 'selected' : '' }}>Ibnu Sabil</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="aktif" {{ old('status', $mustahik->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $mustahik->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('mustahik.index') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>