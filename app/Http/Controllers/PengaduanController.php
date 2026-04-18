<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\PengaduanHistori;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $status = request('status');

        if (auth()->user()->role == 'konsumen') {
            $query = Pengaduan::where('user_id', auth()->id());
        } else {
            $query = Pengaduan::query();
        }

        if ($status) {
            $query->where('status', $status);
        }

        $pengaduans = $query->latest()->get();

        return view('pengaduan.index', compact('pengaduans', 'status'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('histori')->findOrFail($id);

        if (auth()->user()->role == 'konsumen' && $pengaduan->user_id != auth()->id()) {
            abort(403);
        }

        return view('pengaduan.show', compact('pengaduan'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'keluhan' => 'required',
        ]);

        $pengaduan = Pengaduan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'keluhan' => $request->keluhan,
            'tanggal_pengaduan' => now()->toDateString(),
            'status' => 'baru',
        ]);

        PengaduanHistori::create([
            'pengaduan_id' => $pengaduan->id,
            'status' => 'baru',
            'keterangan' => $this->getKeteranganStatus('baru'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'foto_perbaikan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'status' => $request->status,
        ];

        if ($request->hasFile('foto_perbaikan')) {
            if ($pengaduan->foto_perbaikan && Storage::disk('public')->exists($pengaduan->foto_perbaikan)) {
                Storage::disk('public')->delete($pengaduan->foto_perbaikan);
            }

            $data['foto_perbaikan'] = $request->file('foto_perbaikan')->store('foto_perbaikan', 'public');
        }

        $pengaduan->update($data);

        PengaduanHistori::create([
            'pengaduan_id' => $pengaduan->id,
            'status' => $request->status,
            'keterangan' => $this->getKeteranganStatus($request->status),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Status pengaduan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }

    private function getKeteranganStatus($status)
    {
        return match ($status) {
            'baru' => 'Pengaduan berhasil dikirim oleh konsumen dan sedang menunggu diterima oleh admin.',
            'diproses' => 'Pengaduan sudah diterima oleh admin. Admin sedang memeriksa keluhan dan menyiapkan tindak lanjut.',
            'diteruskan_lapangan' => 'Pengaduan sudah diteruskan oleh admin ke bagian lapangan untuk dilakukan pengecekan dan penanganan.',
            'dikerjakan' => 'Petugas lapangan sedang mengerjakan perbaikan sesuai pengaduan yang masuk.',
            'selesai' => 'Perbaikan sudah selesai dikerjakan. Konsumen dapat melihat hasil penanganan dan foto bukti perbaikan jika tersedia.',
            default => 'Status pengaduan diperbarui.',
        };
    }
}
