@extends('layouts.app')

@section('content')
<section class="page-shell form-shell" aria-labelledby="page-title">
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1 id="page-title">Edit mahasiswa</h1>
            <p class="page-description">Perbarui informasi mahasiswa dan kelasnya.</p>
        </div>
        <a class="button button-secondary" href="{{ route('user.index') }}">Kembali ke daftar</a>
    </div>

    @if (session('error'))
        <div class="flash-message flash-error" role="alert">
            <span class="flash-icon" aria-hidden="true">!</span>
            <span>{{ session('error') }}</span>
        </div>
    @elseif ($errors->any())
        <div class="flash-message flash-error" role="alert">
            <span class="flash-icon" aria-hidden="true">!</span>
            <span>Periksa kembali data yang dimasukkan. Ada isian yang belum valid.</span>
        </div>
    @endif

    <form class="form-panel" action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field-group">
            <label for="nama">Nama lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" autocomplete="name" required maxlength="255" @error('nama') aria-invalid="true" aria-describedby="nama-error" @enderror>
            @error('nama') <p class="field-error" id="nama-error">{{ $message }}</p> @enderror
        </div>

        <div class="field-group">
            <label for="npm">NPM</label>
            <input type="text" id="npm" name="npm" value="{{ old('npm', $user->nim) }}" inputmode="numeric" required maxlength="255" @error('npm') aria-invalid="true" aria-describedby="npm-error" @enderror>
            @error('npm') <p class="field-error" id="npm-error">{{ $message }}</p> @enderror
        </div>

        <div class="field-group">
            <label for="kelas">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $user->kelas->nama_kelas ?? '') }}" required maxlength="255" placeholder="Masukkan nama kelas" @error('kelas') aria-invalid="true" aria-describedby="kelas-error" @enderror>
            @error('kelas') <p class="field-error" id="kelas-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ route('user.index') }}">Batal</a>
            <button class="button button-primary" type="submit">Simpan perubahan</button>
        </div>
    </form>
</section>
@endsection
