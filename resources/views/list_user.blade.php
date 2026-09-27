@extends('layouts.app')

@section('content')
<section class="page-shell" aria-labelledby="page-title">
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1 id="page-title">Daftar pengguna</h1>
            <p class="page-description">Kelola data pengguna dan kelas dalam satu tempat.</p>
        </div>
        <a class="button button-primary" href="{{ route('user.create') }}"><span aria-hidden="true">+</span> Tambah pengguna</a>
    </div>

    <div class="list-toolbar">
        <div>
            <span class="toolbar-label">Total pengguna</span>
            <strong class="total-count">{{ $users->count() }}</strong>
        </div>
        <span class="toolbar-note">Data terbaru</span>
    </div>

    <section class="table-panel" aria-label="Tabel daftar pengguna">
        <x-data-table
            :rows="$users"
            :columns="[
                ['label' => 'ID', 'key' => 'id'],
                ['label' => 'Nama', 'key' => 'nama'],
                ['label' => 'NPM', 'key' => 'nim'],
                ['label' => 'Kelas', 'key' => 'nama_kelas'],
            ]"
        />
    </section>
</section>
@endsection