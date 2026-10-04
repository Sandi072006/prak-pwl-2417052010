@extends('layouts.app')

@section('content')
<section class="page-shell form-shell" aria-labelledby="page-title">
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1 id="page-title">Tambah mata kuliah</h1>
            <p class="page-description">Informasi mata kuliah baru.</p>
        </div>
        <a class="button button-secondary" href="{{ url('/matakuliah') }}">Kembali ke daftar</a>
    </div>

    <form class="form-panel" action="{{ route('matakuliah.store') }}" method="POST">
        @csrf

        <div class="field-group">
            <label for="nama_mk">Nama mata kuliah</label>
            <input type="text" id="nama_mk" name="nama_mk" value="{{ old('nama_mk') }}" required maxlength="100" autocomplete="off">
        </div>

        <div class="field-group">
            <label for="sks">Jumlah SKS</label>
            <input type="number" id="sks" name="sks" value="{{ old('sks') }}" min="1" step="1" required inputmode="numeric">
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ url('/matakuliah') }}">Batal</a>
            <button class="button button-primary" type="submit">Simpan mata kuliah</button>
        </div>
    </form>
</section>
@endsection