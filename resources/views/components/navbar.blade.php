<div class="top-bar">
  <div class="container">
    <span
      ><i class="fas fa-map-marker-alt"></i> Kompleks Perkantoran Pemkab
      Mesuji, Lampung</span
    >
    <div class="user-session dropdown">
      <a
        href="#"
        class="dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <img
          src="https://via.placeholder.com/40"
          alt="User"
          class="user-avatar"
        />
        <span class="username">Nama Pengguna</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#">Setting Akun</a></li>
        <li><a class="dropdown-item" href="#">Login</a></li>
      </ul>
    </div>
  </div>
</div>

<header class="main-header">
  <div class="container header-flex">
    <div class="logo-area">
      <a href="{{ url('/') }}">
        <img
          src="{{ asset('assets/images/logo-mesuji.png') }}"
          alt="Logo Mesuji"
          class="logo mesuji"
        />
      </a>
      <a href="{{ url('/') }}">
        <img
          src="{{ asset('assets/images/upbj-mesuji.png') }}"
          alt="Logo UKPBJ"
          class="logo ukpbj"
        />
      </a>
      <div class="logo-text">
        <h1>Bagian Pengadaan Barang dan Jasa</h1>
        <h2>Sekretariat Daerah Kabupaten Mesuji</h2>
      </div>
    </div>
    <div class="search-box">
      <input type="text" placeholder="Search..." />
      <button><i class="fas fa-search"></i></button>
    </div>
  </div>
</header>

<nav class="navbar">
  <div class="container">
    <a href="{{ url('/') }}">
      <img
        src="{{ asset('assets/images/logo-mesuji.png') }}"
        alt="Logo Mesuji"
        class="logo mobile-logo"
      />
    </a>
    <ul class="nav-links">
      <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
      <li><a href="{{ url('/profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">Profil</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle {{ (request()->is('berita') || request()->is('pengumuman') || request()->is('regulasi')) ? 'active' : '' }}" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('/berita') }}" class="{{ request()->is('berita') ? 'active' : '' }}">Berita</a></li>
          <li><a href="{{ url('/pengumuman') }}" class="{{ request()->is('pengumuman') ? 'active' : '' }}">Pengumuman</a></li>
          <li><a href="{{ url('/regulasi') }}" class="{{ request()->is('regulasi') ? 'active' : '' }}">Regulasi</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Layanan</a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('/kontak') }}">Konsultasi PBJ</a></li>
          <li><a href="{{ url('/kontak') }}">Aduan Kritik dan Saran</a></li>
          <li><a href="{{ url('/simonpraja') }}">Simonpraja</a></li>
        </ul>
      </li>
      <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Kontak</a></li>
    </ul>
    <button id="openNavBtn" class="hamburger-btn">&#9776;</button>
  </div>
</nav>

<!-- Sidenav & Overlay -->
<div id="overlay" class="overlay"></div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" id="closeNavBtn" class="close-btn">&times;</a>
  <!-- Konten nav-links disalin di sini oleh script -->
  <ul class="nav-links"></ul>
</div>