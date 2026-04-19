<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\PengaduanHistori;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengaduanController extends Controller
{
    public function index()
    {
        $status = request('status');

        if (auth()->user()->role == 'konsumen') {
            $query = Pengaduan::where('user_id', auth()->id());
        } elseif (auth()->user()->role == 'lapangan') {
            $query = Pengaduan::where('assigned_to', auth()->id());
        } else {
            $query = Pengaduan::query();
        }

        if ($status) {
            $query->where('status', $status);
        }

        $pengaduans = $query->with(['user', 'petugas'])->latest()->get();
        $petugasLapangan = User::where('role', 'lapangan')->orderBy('name')->get();

        return view('pengaduan.index', compact('pengaduans', 'status', 'petugasLapangan'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['histori', 'user', 'petugas'])->findOrFail($id);

        if (auth()->user()->role == 'konsumen' && $pengaduan->user_id != auth()->id()) {
            abort(403);
        }

        if (auth()->user()->role == 'lapangan' && $pengaduan->assigned_to != auth()->id()) {
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
            'foto_pengaduan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPengaduan = null;

        if ($request->hasFile('foto_pengaduan')) {
            $fotoPengaduan = $request->file('foto_pengaduan')->store('foto_pengaduan', 'public');
        }

        $pengaduan = Pengaduan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'keluhan' => $request->keluhan,
            'foto_pengaduan' => $fotoPengaduan,
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

        if (auth()->user()->role == 'lapangan' && $pengaduan->assigned_to != auth()->id()) {
            abort(403);
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if (auth()->user()->role == 'lapangan' && $pengaduan->assigned_to != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required',
            'assigned_to' => [
                'nullable',
                Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', 'lapangan')),
            ],
            'foto_perbaikan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'status' => $request->status,
        ];

        if (auth()->user()->role == 'admin' && $request->status == 'diteruskan_lapangan') {
            $request->validate([
                'assigned_to' => 'required',
            ]);

            $data['assigned_to'] = $request->assigned_to;
        }

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
            'keterangan' => $this->getKeteranganStatus($request->status, $data['assigned_to'] ?? $pengaduan->assigned_to),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Status pengaduan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->foto_pengaduan && Storage::disk('public')->exists($pengaduan->foto_pengaduan)) {
            Storage::disk('public')->delete($pengaduan->foto_pengaduan);
        }

        if ($pengaduan->foto_perbaikan && Storage::disk('public')->exists($pengaduan->foto_perbaikan)) {
            Storage::disk('public')->delete($pengaduan->foto_perbaikan);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }

    private function getKeteranganStatus($status, $assignedTo = null)
    {
        $petugas = $assignedTo ? User::find($assignedTo) : null;

        return match ($status) {
            'baru' => 'Pengaduan berhasil dikirim oleh konsumen dan sedang menunggu diterima oleh admin.',
            'diproses' => 'Pengaduan sudah diterima oleh admin. Admin sedang memeriksa keluhan dan menyiapkan tindak lanjut.',
            'diteruskan_lapangan' => 'Pengaduan sudah diteruskan oleh admin kepada ' . ($petugas?->name ?? 'petugas lapangan') . ' untuk dilakukan pengecekan dan penanganan.',
            'dikerjakan' => 'Petugas lapangan sedang mengerjakan perbaikan sesuai pengaduan yang masuk.',
            'selesai' => 'Perbaikan sudah selesai dikerjakan. Konsumen dapat melihat hasil penanganan dan foto bukti perbaikan jika tersedia.',
            default => 'Status pengaduan diperbarui.',
        };
    }
}
