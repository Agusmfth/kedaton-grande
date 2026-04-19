<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\SerahTerimaKunci;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorizeAccess();

        $data = $this->getLaporanData($request);

        return view('laporan.index', $data);
    }

    public function cetak(Request $request): View
    {
        $this->authorizeAccess();

        $data = $this->getLaporanData($request);

        return view('laporan.cetak', $data);
    }

    private function getLaporanData(Request $request): array
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $serahTerimaQuery = SerahTerimaKunci::with('user')->latest('tanggal_serah_terima');
        $pengaduanQuery = Pengaduan::with(['user', 'petugas'])->latest('tanggal_pengaduan');

        if ($tanggalAwal) {
            $serahTerimaQuery->whereDate('tanggal_serah_terima', '>=', $tanggalAwal);
            $pengaduanQuery->whereDate('tanggal_pengaduan', '>=', $tanggalAwal);
        }

        if ($tanggalAkhir) {
            $serahTerimaQuery->whereDate('tanggal_serah_terima', '<=', $tanggalAkhir);
            $pengaduanQuery->whereDate('tanggal_pengaduan', '<=', $tanggalAkhir);
        }

        $serahTerima = $serahTerimaQuery->get();
        $pengaduan = $pengaduanQuery->get();

        return [
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'serahTerima' => $serahTerima,
            'pengaduan' => $pengaduan,
            'totalSerahTerima' => $serahTerima->count(),
            'totalPengaduan' => $pengaduan->count(),
            'totalBelumSelesai' => $pengaduan->whereIn('status', [
                'baru',
                'diproses',
                'diteruskan_lapangan',
                'dikerjakan',
            ])->count(),
            'totalSelesai' => $pengaduan->where('status', 'selesai')->count(),
        ];
    }

    private function authorizeAccess(): void
    {
        if (! in_array(auth()->user()->role, ['admin', 'pimpinan'])) {
            abort(403);
        }
    }
}
