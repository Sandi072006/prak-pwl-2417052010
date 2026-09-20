<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($nama = '', $npm = '', $kelas = '')
    {
        $data = [
            'nama' => 'Sandi',
            'npm' => '2417052010',
            'kelas' => 'SI24'
        ];
        return view('profile', compact('data'));
    }
}
