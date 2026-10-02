<x-app-layout>
<style>
    /* Judul dalam kotak putih seperti navbar */
    .title-box {
        background: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }
    .title-box h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .info-box .label {
        font-size: 0.85rem;
        color: #084298;
        margin-bottom: 5px;
    }
    .info-box .value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0d6efd;
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .filter-input {
        padding: 8px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 0.9rem;
        background: #fff;
        color: #495057;
    }
    .filter-input.search { width: 220px; }
    .filter-btn {
        background: #0d6efd;
        color: #fff;
        border: none;
        padding: 9px 22px;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .filter-btn:hover { background: #0b5ed7; }
    .btn-add {
        background: #198754;
        color: #fff;
        padding: 9px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        margin-left: auto;
    }
    .btn-add:hover { background: #146c43; color: #fff; }

    /* Table — SAMA PERSIS dengan Penyaluran */
    .table-wrap {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        overflow: hidden;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table thead tr {
        border-bottom: 1px solid #e9ecef;
    }
    .data-table th {
        padding: 18px 20px;
        text-align: left;
        font-size: 0.88rem;
        font-weight: 600;
        color: #212529;
    }
    .data-table td {
        padding: 18px 20px;
        font-size: 0.88rem;
        color: #333;
    }
    .data-table tbody tr {
        border-bottom: 1px solid #f1f3f5;
    }
    .data-table tbody tr:hover { background: #f8f9fa; }
    .data-table tbody tr:last-child td { border-bottom: none; }

    .badge-status {
        padding: 5px 14px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    .badge-valid { background: #d1e7dd; color: #0f5132; }
    .badge-pending { background: #fff3cd; color: #664d03; }

    .action-link { text-decoration: none; font-size: 0.88rem; }
    .link-lihat { color: #0d6efd; }
    .link-edit { color: #fd7e14; margin-left: 15px; }
    .link-hapus {
        color: #dc3545; background: none; border: none;
        padding: 0; cursor: pointer; font-size: 0.88rem; margin-left: 15px;
    }

    /* Pagination */
    .pagination-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: #fff;
        border-top: 1px solid #f1f3f5;
        flex-wrap: wrap;
        gap: 15px;
    }
    .pagination-info { font-size: 0.85rem; color: #6c757d; }
    .pagination-nav { display: flex; gap: 6px; align-items: center; }
    .page-btn {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 36px; height: 36px; padding: 0 12px;
        border: 1px solid #dee2e6; background: #fff; color: #495057;
        border-radius: 6px; text-decoration: none; font-size: 0.88rem;
        font-weight: 500;
    }
    .page-btn:hover { background: #f1f3f5; color: #212529; }
    .page-btn.active { background: #0d6efd; color: #fff; border-color: #0d6efd; font-weight: 700; }
    .page-btn.disabled { color: #adb5bd; background: #f8f9fa; pointer-events: none; }
</style>

<div class="container-fluid px-4">

    <!-- Judul dalam kotak putih -->
    <div class="title-box">
        <h3>Penerimaan Dana</h3>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <form method="GET" style="display: contents;">
            <input type="text" name="search" class="filter-input search" placeholder="Cari transaksi..." value="{{ request('search') }}">
            <select name="status" class="filter-input">
                <option value="">Semua Status</option>
                <option value="valid" {{ request('status') == 'valid' ? 'selected' : '' }}>Valid</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
            <button type="submit" class="filter-btn">Filter</button>
        </form>
        <a href="{{ route('penerimaan.create') }}" class="btn-add">+ Tambah Penerimaan</a>
    </div>

    <!-- Tabel -->
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Muzakki/Donatur</th>
                    <th>Jenis Dana</th>
                    <th>Nominal</th>
                    <th>Tersalurkan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penerimaan as $p)
                <tr>
                    <td>{{ $p->nomor_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $p->muzakki->nama ?? $p->nama_donatur ?? 'Anonim' }}</td>
                    <td>{{ ucfirst($p->jenis_dana) }}</td>
                    <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    <td>-</td>
                    <td>
                        @if($p->status == 'valid')
                            <span class="badge-status badge-valid">Valid</span>
                        @elseif($p->status == 'pending')
                            <span class="badge-status badge-pending">Pending</span>
                        @else
                            <span class="badge-status badge-valid">{{ $p->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('penerimaan.show', $p->id) }}" class="action-link link-lihat">Lihat</a>
                        <a href="{{ route('penerimaan.edit', $p->id) }}" class="action-link link-edit">Edit</a>
                        <form action="{{ route('penerimaan.destroy', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-link link-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center; padding:30px; color:#6c757d;">Belum ada data penerimaan.</td></tr>
                @endforelse
            </tbody>
        </table>

        @if($penerimaan->hasPages())
        <div class="pagination-wrap">
            <div class="pagination-info">
                Menampilkan {{ $penerimaan->firstItem() }} - {{ $penerimaan->lastItem() }} dari {{ $penerimaan->total() }} data
            </div>
            <div class="pagination-nav">
                @if ($penerimaan->onFirstPage())
                    <span class="page-btn disabled">‹ Prev</span>
                @else
                    <a href="{{ $penerimaan->previousPageUrl() }}" class="page-btn">‹ Prev</a>
                @endif

                @foreach ($penerimaan->getUrlRange(1, $penerimaan->lastPage()) as $page => $url)
                    @if ($page == $penerimaan->currentPage())
                        <span class="page-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($penerimaan->hasMorePages())
                    <a href="{{ $penerimaan->nextPageUrl() }}" class="page-btn">Next ›</a>
                @else
                    <span class="page-btn disabled">Next ›</span>
                @endif
            </div>
        </div>
        @endif
    </div>

</div>
</x-app-layout>