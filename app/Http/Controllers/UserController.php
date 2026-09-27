<?php

namespace App\Http\Controllers;


use App\Models\UserModel;
use App\Models\Kelas;
use Illuminate\Http\Request;

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
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];
        return view('create_user', $data);
    }
    
    public function store(Request $request) {
    $validated = $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'npm' => ['required', 'string', 'max:255'],
        'kelas' => ['required', 'string', 'max:255', 'exists:kelas,nama_kelas'],
    ]);

    $this->userModel->create([
        'nama' => $validated['nama'],
        'nim' => $validated['npm'],
        'kelas_id' => $this->kelasModel
            ->where('nama_kelas', $validated['kelas'])
            ->value('id'),
    ]);
        return redirect()->to('/user');
    }

    public function index() {
    $data = [
    'title' => 'List User',
    'users' => $this->userModel->getUser(),
    ];
    return view('list_user', $data);
}
}
