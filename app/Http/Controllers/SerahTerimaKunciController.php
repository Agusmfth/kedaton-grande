<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SerahTerimaKunci;
use Illuminate\Support\Facades\Hash;

class SerahTerimaKunciController extends Controller
{
    public function index()
    {
        $data = SerahTerimaKunci::with('user')->latest()->get();
        return view('serah_terima.index', compact('data'));
    }

    public function create()
    {
        return view('serah_terima.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'blok' => 'required|string|max:50',
        'tanggal_serah_terima' => 'required|date',
        'keterangan' => 'nullable|string',
    ]);

    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'konsumen',
    ]);

    SerahTerimaKunci::create([
        'user_id' => $user->id,
        'blok' => $request->blok,
        'tanggal_serah_terima' => $request->tanggal_serah_terima,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('serah-terima.index')
        ->with('success', 'Data serah terima dan akun konsumen berhasil dibuat.');
}

    public function edit($id)
    {
        $item = SerahTerimaKunci::with('user')->findOrFail($id);
        return view('serah_terima.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = SerahTerimaKunci::with('user')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $item->user->id,
            'password' => 'nullable|string|min:6',
            'blok' => 'required|string|max:50',
            'tanggal_serah_terima' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $item->user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        if ($request->filled('password')) {
            $item->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $item->update([
            'blok' => $request->blok,
            'tanggal_serah_terima' => $request->tanggal_serah_terima,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('serah-terima.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = SerahTerimaKunci::with('user')->findOrFail($id);

        if ($item->user) {
            $item->user->delete();
        }

        $item->delete();

        return redirect()->route('serah-terima.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
