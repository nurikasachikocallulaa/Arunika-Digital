<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeAdminUtama();
        $petugas = Petugas::orderBy('nama')->paginate(10);
        $pendingUsers = User::where('role', 'petugas')->where('status', 'pending')->get();

        return view('admin.petugas.index', compact('petugas', 'pendingUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeAdminUtama();
        return view('admin.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeAdminUtama();
        $data = $request->validate([
            'nama'    => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => true,
            'role' => 'petugas',
            'status' => 'active',
        ]);

        Petugas::create([
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'email' => $data['email'],
            'no_hp' => null,
            'alamat' => null,
        ]);

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorizeAdminUtama();
        $petuga = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petuga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorizeAdminUtama();
        $data = $request->validate([
            'nama'    => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'email'   => ['nullable', 'email', 'max:255'],
        ]);

        $petuga = Petugas::findOrFail($id);
        $petuga->update($data);

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorizeAdminUtama();
        $petuga = Petugas::findOrFail($id);
        $petuga->delete();

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil dihapus.');
    }

    public function approveUser(string $id)
    {
        $this->authorizeAdminUtama();
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        // Pastikan data petugas tercatat di tabel petugas
        $existingPetugas = Petugas::where('email', $user->email)->first();

        if (!$existingPetugas) {
            Petugas::create([
                'nama' => $user->name,
                'jabatan' => 'petugas',
                'no_hp' => null,
                'email' => $user->email,
                'alamat' => null,
            ]);
        }

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Pengajuan petugas disetujui.');
    }

    public function rejectUser(string $id)
    {
        $this->authorizeAdminUtama();
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Pengajuan petugas ditolak.');
    }

    private function authorizeAdminUtama(): void
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'admin_utama') {
            abort(403);
        }
    }
}
