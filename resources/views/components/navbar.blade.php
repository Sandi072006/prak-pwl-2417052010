<header class="site-header">
    <nav class="nav-wrap" aria-label="Navigasi utama">
        <a class="brand" href="{{ url('/user') }}">
            <span class="brand-mark" aria-hidden="true">U</span>
            <span>Data Pengguna<small>Administrasi kelas</small></span>
        </a>
        <div class="nav-links">
            <a class="nav-link {{ request()->is('user') ? 'is-active' : '' }}" href="{{ url('/user') }}" @if(request()->is('user')) aria-current="page" @endif>Daftar pengguna</a>
            <a class="nav-link {{ request()->is('user/create') ? 'is-active' : '' }}" href="{{ route('user.create') }}" @if(request()->is('user/create')) aria-current="page" @endif>Tambah pengguna</a>
        </div>
    </nav>
</header>