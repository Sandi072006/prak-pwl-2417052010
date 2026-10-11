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

    @if (session('success'))
        <div class="flash-message flash-success" role="status">
            <span class="flash-icon" aria-hidden="true">✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="flash-message flash-error" role="alert">
            <span class="flash-icon" aria-hidden="true">!</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <section class="table-panel" aria-label="Tabel daftar pengguna">
        <div class="table-scroll">
            <table class="data-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NPM</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->nama_kelas }}</td>
                            <td>
                                <div class="table-actions">
                                    <a class="action-button action-edit" href="{{ route('user.edit', $user->id) }}">
                                        <svg aria-hidden="true" viewBox="0 0 20 20" fill="none">
                                            <path d="M11.7 4.1 15.9 8.3M3.5 16.5l3.6-.8L16.2 6.6a1.8 1.8 0 0 0-2.8-2.8L4.3 12.9l-.8 3.6Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-button action-delete" type="submit">
                                            <svg aria-hidden="true" viewBox="0 0 20 20" fill="none">
                                                <path d="M4.5 6h11m-9.8 0 .6 10h7.4l.6-10M8 6V4.5h4V6m-3 3v4m2-4v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="empty-state" colspan="5">Belum ada data mahasiswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</section>
@endsection