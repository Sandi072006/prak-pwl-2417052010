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
        <x-data-table
            :rows="$mks"
            :columns="[
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Nama mata kuliah', 'key' => 'nama_mk'],
                ['label' => 'SKS', 'key' => 'sks'],
            ]"
            empty-message="Belum ada mata kuliah."
        />
    </section>
</section>
@endsection