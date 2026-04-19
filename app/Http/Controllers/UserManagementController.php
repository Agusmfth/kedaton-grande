<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $role = request('role');
        $users = User::when($role, fn ($query) => $query->where('role', $role))
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        return view('users.index', compact('users', 'role'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'lapangan', 'pimpinan', 'konsumen'])],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role' => ['required', Rule::in(['admin', 'lapangan', 'pimpinan', 'konsumen'])],
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->authorizeAdmin();

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }

    private function authorizeAdmin(): void
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
    }
}
