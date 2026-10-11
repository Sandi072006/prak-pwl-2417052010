<?php

namespace App\Http\Controllers;


use App\Models\UserModel;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function create()
    {
        return view('create_user', ['title' => 'Create User']);
    }
    
    public function store(Request $request) {
    $validated = $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'npm' => ['required', 'string', 'max:255'],
        'kelas' => ['required', 'string', 'max:255'],
    ]);

    $this->userModel->create([
        'nama' => $validated['nama'],
        'nim' => $validated['npm'],
        'kelas_id' => $this->kelasModel
            ->firstOrCreate(['nama_kelas' => $validated['kelas']])
            ->id,
    ]);
    return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function index() {
    $data = [
        'title' => 'List User',
        'users' => $this->userModel->getUser(),
    ];
    return view('list_user', $data);
    }

    public function edit(string $id)
    {
    $user = $this->userModel->findOrFail($id);

    return view('edit_user', [
        'title' => 'Edit Mahasiswa',
        'user' => $user,
    ]);
    }

    public function update(Request $request, string $id)
    {
    $validated = $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'npm' => ['required', 'string', 'max:255'],
        'kelas' => ['required', 'string', 'max:255'],
    ]);

    $user = $this->userModel->findOrFail($id);

    try {
        $user->update([
            'nama' => $validated['nama'],
            'nim' => $validated['npm'],
            'kelas_id' => $this->kelasModel
                ->firstOrCreate(['nama_kelas' => $validated['kelas']])
                ->id,
        ]);
    } catch (QueryException $exception) {
        Log::error('Failed to update student record.', [
            'user_id' => $id,
            'exception' => $exception,
        ]);

        return back()->withInput()->with('error', 'Data mahasiswa gagal diperbarui. Silakan coba lagi.');
    }

    return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
    $user = $this->userModel->findOrFail($id);

    try {
        $user->delete();
    } catch (QueryException $exception) {
        Log::error('Failed to delete student record.', [
            'user_id' => $id,
            'exception' => $exception,
        ]);

        return redirect()->route('user.index')
            ->with('error', 'Data mahasiswa gagal dihapus. Data ini mungkin masih digunakan.');
    }

    return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
