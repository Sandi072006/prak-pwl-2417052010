@extends('layouts.app')

@section('content')
<section class="page-shell form-shell" aria-labelledby="page-title">
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1 id="page-title">Tambah pengguna</h1>
            <p class="page-description">Isi informasi pengguna untuk menambahkannya ke daftar.</p>
        </div>
        <a class="button button-secondary" href="{{ url('/user') }}">Kembali ke daftar</a>
    </div>

    <form class="form-panel" action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="field-group">
            <label for="nama">Nama lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" autocomplete="name" required maxlength="255" @error('nama') aria-invalid="true" aria-describedby="nama-error" @enderror>
            @error('nama') <p class="field-error" id="nama-error">{{ $message }}</p> @enderror
        </div>

        <div class="field-group">
            <label for="npm">NPM</label>
            <input type="text" id="npm" name="npm" value="{{ old('npm') }}" inputmode="numeric" required maxlength="255" @error('npm') aria-invalid="true" aria-describedby="npm-error" @enderror>
            @error('npm') <p class="field-error" id="npm-error">{{ $message }}</p> @enderror
        </div>

        <div class="field-group">
            <label for="kelas">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}" list="kelas-options" autocomplete="off" required maxlength="255" placeholder="Ketik nama kelas" @error('kelas') aria-invalid="true" aria-describedby="kelas-error" @enderror>
            <datalist id="kelas-options">
                @foreach ($kelas->unique('nama_kelas') as $kelasItem)
                    <option value="{{ $kelasItem->nama_kelas }}">
                @endforeach
            </datalist>
            @error('kelas') <p class="field-error" id="kelas-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ url('/user') }}">Batal</a>
            <button class="button button-primary" type="submit">Simpan pengguna</button>
        </div>
    </form>
</section>
@endsection
