@extends('layouts.app')

@section('content')
<section class="page-shell" aria-labelledby="page-title">
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1 id="page-title">Daftar mata kuliah</h1>
            <p class="page-description">Data mata kuliah yang tersimpan.</p>
        </div>
        <a class="button button-primary" href="{{ route('matakuliah.create') }}"><span aria-hidden="true">+</span> Tambah mata kuliah</a>
    </div>

    <div class="list-toolbar">
        <div>
            <span class="toolbar-label">Total mata kuliah</span>
            <strong class="total-count">{{ $mks->count() }}</strong>
        </div>
        <span class="toolbar-note">Data akademik</span>
    </div>

    <section class="table-panel" aria-label="Tabel daftar mata kuliah">
        <table class="data-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="text-align: left; padding: 10px;">ID</th>
                    <th style="text-align: left; padding: 10px;">Nama mata kuliah</th>
                    <th style="text-align: left; padding: 10px;">SKS</th>
                    <th style="text-align: left; padding: 10px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mks as $mk)
                    <tr>
                        <td style="padding: 10px;">{{ $mk->id }}</td>
                        <td style="padding: 10px;">{{ $mk->nama_mk }}</td>
                        <td style="padding: 10px;">{{ $mk->sks }}</td>
                        <td style="padding: 10px;">
                            <a href="{{ route('matakuliah.edit', $mk->id) }}">Edit</a>
                            <form action="{{ route('matakuliah.destroy', $mk->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</section>
@endsection