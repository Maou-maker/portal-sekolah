<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Guru - MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
        }
    </style>
</head>

<body class="bg-light">

    <!-- NAVBAR / HOTBAR NAVIGASI -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill me-2"></i> MA HASANUDDIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('media-sosial') }}">Media Sosial</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}">Profil</a></li>
                    <li class="nav-item">
                        <a href="{{ route('profil.guru') }}" class="btn btn-success btn-sm px-3 fw-bold">
                            <i class="bi bi-people-fill me-1"></i> Direktori Guru
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA DIREKTORI GURU -->
    <div class="container my-5 content-wrapper">

        <!-- JUDUL HALAMAN -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1"><i class="bi bi-people-fill text-success me-2"></i> Direktori Guru &
                    Pimpinan</h3>
                <p class="text-muted small mb-0">Daftar lengkap tenaga pendidik dan kependidikan MA Hasanuddin</p>
            </div>
            <span class="badge bg-success px-3 py-2">Total: {{ $teachers->count() }} Pegawai</span>
        </div>

        <div class="row g-4">

            <!-- KOLOM KIRI: SEARCH & SORTIR -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 90px;">
                    <form action="{{ route('profil.guru') }}" method="GET">

                        <!-- Search Nama / NIP -->
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary"><i class="bi bi-search me-1"></i>
                                Cari Nama / NIP</label>
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Ketik nama atau NIP..." value="{{ request('search') }}">
                        </div>

                        <hr class="text-muted opacity-25">

                        <!-- Sortir Kelamin -->
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary"><i
                                    class="bi bi-gender-ambiguous me-1"></i> Kelamin</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option value="">Semua Kelamin</option>
                                <option value="L" {{ request('gender') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                <option value="P" {{ request('gender') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                            </select>
                        </div>

                        <!-- Sortir Jabatan / Peran -->
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary"><i
                                    class="bi bi-shield-check me-1"></i> Peran / Jabatan</label>
                            <select name="role" class="form-select form-select-sm">
                                <option value="">Semua Peran</option>
                                <option value="headmaster" {{ request('role') == 'headmaster' ? 'selected' : '' }}>Kepala
                                    Sekolah</option>
                                <option value="foundation_head" {{ request('role') == 'foundation_head' ? 'selected' : '' }}>Kepala Yayasan</option>
                                <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Guru Biasa
                                </option>
                            </select>
                        </div>

                        <!-- Tombol Aksi Filter -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-sm fw-bold">Terapkan Filter</button>
                            <a href="{{ route('profil.guru') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- KOLOM KANAN: GRID CARD GURU (FOTO KIRI, TEKS KANAN SESUAI CANVAS) -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @forelse($teachers as $t)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                                <div class="row g-0 h-100 align-items-center">

                                    <!-- FOTO GURU DI KIRI -->
                                    <div class="col-5 position-relative h-100 bg-secondary" style="min-height: 180px;">
                                        <img src="{{ $t->photo ? asset('storage/' . $t->photo) : 'https://via.placeholder.com/150' }}"
                                            class="w-100 h-100 position-absolute top-0 start-0" style="object-fit: cover;">
                                        <!-- Role Badge di atas foto -->
                                        <span
                                            class="position-absolute top-0 start-0 m-2 badge {{ $t->role == 'headmaster' ? 'bg-success' : ($t->role == 'foundation_head' ? 'bg-dark' : 'bg-primary') }}"
                                            style="font-size: 10px;">
                                            {{ $t->role == 'headmaster' ? 'Kepala Sekolah' : ($t->role == 'foundation_head' ? 'Kepala Yayasan' : 'Guru') }}
                                        </span>
                                    </div>

                                    <!-- DETAIL INFORMASI DI KANAN (Tanpa Alamat, Sesuai Request) -->
                                    <div class="col-7">
                                        <div class="card-body p-3">
                                            <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $t->name }}</h6>
                                            <p class="text-success small fw-bold mb-2 text-truncate">{{ $t->position }}</p>

                                            <div class="small text-muted border-top pt-2">
                                                <div class="mb-1">
                                                    <span class="d-block text-secondary"
                                                        style="font-size: 11px;">NIP/NIY:</span>
                                                    <span class="fw-semibold text-dark">{{ $t->nip ?? '-' }}</span>
                                                </div>
                                                <div class="mb-0">
                                                    <span class="d-block text-secondary"
                                                        style="font-size: 11px;">Kelamin:</span>
                                                    <span
                                                        class="fw-semibold text-dark">{{ $t->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="card border-0 shadow-sm rounded-4 p-5 bg-white">
                                <i class="bi bi-search display-4 text-muted mb-3"></i>
                                <h5 class="fw-bold text-dark">Data Guru Tidak Ditemukan</h5>
                                <p class="text-muted small mb-3">Tidak ada pegawai yang cocok dengan kriteria pencarian atau
                                    filter yang kamu pilih.</p>
                                <a href="{{ route('profil.guru') }}"
                                    class="btn btn-outline-success btn-sm w-25 mx-auto">Reset Pencarian</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    <!-- FOOTER (Menempel rapi di bawah) -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <p class="small mb-0">&copy; 2026 MA Hasanuddin. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>