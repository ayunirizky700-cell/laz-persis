<?php
namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Penyaluran;
use App\Models\Muzakki;
use App\Models\Mustahik;
use App\Models\Program;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{

    public function index()
    {
        return view('laporan.index');
    }

    public function penerimaan(Request $request)
    {
        $query = Penerimaan::with(['muzakki', 'program'])->where('status', 'valid');

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }
        if ($request->filled('jenis_dana')) {
            $query->where('jenis_dana', $request->jenis_dana);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();
        $total = $data->sum('nominal');

        return view('laporan.penerimaan', compact('data', 'total'));
    }

    public function penyaluran(Request $request)
    {
        $query = Penyaluran::with(['program', 'mustahik'])
            ->whereIn('status', ['disetujui', 'direalisasi']);

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_pengajuan', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_pengajuan', '<=', $request->tanggal_selesai);
        }

        $data = $query->orderBy('tanggal_pengajuan', 'desc')->get();
        $total = $data->sum('nominal');

        return view('laporan.penyaluran', compact('data', 'total'));
    }

    public function program()
    {
        $program = Program::all();
        return view('laporan.program', compact('program'));
    }

    public function rekapSaldo(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai ?? now()->startOfMonth()->format('Y-m-d');
        $tanggalSelesai = $request->tanggal_selesai ?? now()->format('Y-m-d');

        $totalPenerimaan = Penerimaan::where('status', 'valid')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->sum('nominal');

        $totalPenyaluran = Penyaluran::whereIn('status', ['disetujui', 'direalisasi'])
            ->whereBetween('tanggal_pengajuan', [$tanggalMulai, $tanggalSelesai])
            ->sum('nominal');

        $saldo = $totalPenerimaan - $totalPenyaluran;

        return view('laporan.rekap-saldo', compact(
            'totalPenerimaan',
            'totalPenyaluran',
            'saldo',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }

    // ============ EXPORT PDF ============

    public function penerimaanPdf(Request $request)
    {
        $query = Penerimaan::with(['muzakki', 'program'])->where('status', 'valid');

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();
        $total = $data->sum('nominal');
        $tanggalCetak = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('laporan.pdf.penerimaan', compact(
            'data',
            'total',
            'tanggalCetak',
            'request'
        ));

        return $pdf->download('laporan-penerimaan-' . date('Y-m-d') . '.pdf');
    }

    public function penyaluranPdf(Request $request)
    {
        $query = Penyaluran::with(['program', 'mustahik'])
            ->whereIn('status', ['disetujui', 'direalisasi']);

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_pengajuan', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_pengajuan', '<=', $request->tanggal_selesai);
        }

        $data = $query->orderBy('tanggal_pengajuan', 'desc')->get();
        $total = $data->sum('nominal');
        $tanggalCetak = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('laporan.pdf.penyaluran', compact(
            'data',
            'total',
            'tanggalCetak',
            'request'
        ));

        return $pdf->download('laporan-penyaluran-' . date('Y-m-d') . '.pdf');
    }

    public function programPdf()
    {
        $program = Program::all();
        $tanggalCetak = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('laporan.pdf.program', compact('program', 'tanggalCetak'));

        return $pdf->download('laporan-program-' . date('Y-m-d') . '.pdf');
    }

    public function rekapSaldoPdf(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai ?? now()->startOfMonth()->format('Y-m-d');
        $tanggalSelesai = $request->tanggal_selesai ?? now()->format('Y-m-d');

        $totalPenerimaan = Penerimaan::where('status', 'valid')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->sum('nominal');

        $totalPenyaluran = Penyaluran::whereIn('status', ['disetujui', 'direalisasi'])
            ->whereBetween('tanggal_pengajuan', [$tanggalMulai, $tanggalSelesai])
            ->sum('nominal');

        $saldo = $totalPenerimaan - $totalPenyaluran;
        $tanggalCetak = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('laporan.pdf.rekap-saldo', compact(
            'totalPenerimaan',
            'totalPenyaluran',
            'saldo',
            'tanggalMulai',
            'tanggalSelesai',
            'tanggalCetak'
        ));

        return $pdf->download('rekap-saldo-' . date('Y-m-d') . '.pdf');
    }
}