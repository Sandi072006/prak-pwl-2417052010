@extends('layouts.app')

@section('content')
<section class="page-shell form-shell" aria-labelledby="page-title">
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1 id="page-title">Edit mata kuliah</h1>
            <p class="page-description">Perbarui informasi mata kuliah.</p>
        </div>
        <a class="button button-secondary" href="{{ url('/matakuliah') }}">
            Kembali ke daftar
        </a>
    </div>

    <form class="form-panel" action="{{ route('matakuliah.update', $mk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field-group">
            <label for="nama_mk">Nama mata kuliah</label>
            <input
                type="text"
                id="nama_mk"
                name="nama_mk"
                value="{{ old('nama_mk', $mk->nama_mk) }}"
                required
                maxlength="100"
                autocomplete="off"
            >
        </div>

        <div class="field-group">
            <label for="sks">Jumlah SKS</label>
            <input
                type="number"
                id="sks"
                name="sks"
                value="{{ old('sks', $mk->sks) }}"
                min="1"
                step="1"
                required
                inputmode="numeric"
            >
        </div>

        <div class="form-actions">
            <a class="button button-secondary" href="{{ url('/matakuliah') }}">
                Batal
            </a>

            <button class="button button-primary" type="submit">
                Update mata kuliah
            </button>
        </div>
    </form>
</section>
@endsection