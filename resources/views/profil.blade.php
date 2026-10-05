<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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
                    <li class="nav-item"><a class="nav-link active fw-bold text-success"
                            href="{{ route('profil') }}">Profil</a></li>
                    <li class="nav-item">
                        <a href="{{ route('profil.guru') }}" class="btn btn-outline-success btn-sm px-3">
                            <i class="bi bi-people-fill me-1"></i> Direktori Guru
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA PROFIL -->
    <div class="container my-5">

        <!-- BAGIAN ATAS: KOTAK FOTO SECTION (FOTO TERBUKA JELAS) & DESKRIPSI -->
        <div class="row g-4 mb-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 text-white p-4 d-flex justify-content-center align-items-center text-center position-relative bg-dark"
                    style="min-height: 280px;">
                    @if(isset($firstSection->image) && $firstSection->image)
                        <!-- Foto background terbuka jelas dengan sedikit efek gelap tipis agar teks terbaca -->
                        <img src="{{ asset('storage/' . $firstSection->image) }}"
                            class="position-absolute w-100 h-100 top-0 start-0"
                            style="object-fit: cover; filter: brightness(0.65);">
                    @else
                        <div class="position-absolute w-100 h-100 top-0 start-0 bg-primary"></div>
                    @endif
                    <div style="z-index: 2;" class="position-relative">
                        <i class="bi bi-building-fill-check display-1 mb-2 text-success"></i>
                        <h3 class="fw-bold text-white">{{ $firstSection->title ?? 'MA Hasanuddin' }}</h3>
                        <p class="mb-0 text-light small fw-bold">Unggul, Berilmu, dan Berakhlaqul Karimah</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <h4 class="fw-bold text-success mb-3"><i class="bi bi-info-circle-fill me-2"></i> Sejarah &
                        Deskripsi Profil</h4>
                    <p class="text-muted" style="line-height: 1.8;">
                        {!! $firstSection->content ?? 'Madrasah Aliyah (MA) Hasanuddin merupakan lembaga pendidikan berbasis Islam yang berkomitmen tinggi dalam mencetak generasi bangsa yang cerdas secara intelektual, matang secara spiritual, serta berkarakter luhur. Berdiri di bawah naungan yayasan terpercaya, madrasah kami terus berinovasi dalam sistem pembelajaran berbasis teknologi dan keagamaan.' !!}
                    </p>
                </div>
            </div>
        </div>

        <!-- BAGIAN TENGAH: VISI MISI & PIMPINAN (FOTO GURU DIBIKIN BESAR & ELEGAN) -->
        <div class="row g-4 mb-5">
            <!-- Visi Misi -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-info text-dark">
                    <h4 class="fw-bold mb-3"><i class="bi bi-bullseye me-2"></i> Visi & Misi Madrasah</h4>
                    <div class="mb-3">
                        <h6 class="fw-bold text-dark text-uppercase small">Visi:</h6>
                        @foreach($visions as $v)
                            <p class="fst-italic mb-2">"{{ $v->content }}"</p>
                        @endforeach
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark text-uppercase small">Misi:</h6>
                        <ul class="mb-0 ps-3">
                            @foreach($missions as $m)
                                <li class="mb-1">{{ $m->content }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pimpinan / Kepala Sekolah & Yayasan (FOTO BESAR) -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center">
                    <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-award-fill me-2"></i> Pimpinan Madrasah</h5>
                    @forelse($pimpinans as $p)
                        <div class="p-3 border rounded-4 mb-3 bg-light text-center">
                            <img src="{{ $p->photo ? asset('storage/' . $p->photo) : 'https://via.placeholder.com/150' }}"
                                class="rounded-circle shadow mb-3 mx-auto d-block"
                                style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #198754;">
                            <span class="badge {{ $p->role == 'headmaster' ? 'bg-success' : 'bg-dark' }} mb-2 px-3 py-1">
                                {{ $p->role == 'headmaster' ? 'Kepala Sekolah' : 'Kepala Yayasan' }}
                            </span>
                            <h4 class="fw-bold mb-1 text-dark">{{ $p->name }}</h4>
                            <p class="text-muted small mb-0">{{ $p->position }}</p>
                        </div>
                    @empty
                        <p class="text-muted my-auto">Data pimpinan belum diatur.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- NAVIGASI & SORTIR SECTION (EVENT & PROGRAM) -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
            <h4 class="fw-bold text-dark mb-0"><i class="bi bi-stars text-warning me-2"></i> Program & Kegiatan Tahunan
            </h4>
            <span class="badge bg-success">MA Hasanuddin</span>
        </div>

        <!-- EVENT TAHUNAN GRID -->
        <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-calendar-event me-2"></i> Event Tahunan</h5>
        <div class="row g-4 mb-5">
            @forelse($events as $ev)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <img src="{{ $ev->image ? asset('storage/' . $ev->image) : 'https://via.placeholder.com/300x180' }}"
                            class="w-100" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="fw-bold text-dark">{{ $ev->title }}</h6>
                            <p class="small text-muted mb-0">{{ Str::limit($ev->description, 90) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada event tahunan.</div>
            @endforelse
        </div>

        <!-- PROGRAM UNGGULAN -->
        <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-gear-wide-connected me-2"></i> Program Unggulan</h5>
        <div class="row g-4">
            @forelse($programs as $prog)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                        @if($prog->image)
                            <img src="{{ asset('storage/' . $prog->image) }}" class="w-100"
                                style="height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark">{{ $prog->title }}</h5>
                            <p class="text-muted small mb-0">{{ $prog->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-3">Belum ada program madrasah.</div>
            @endforelse
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="small mb-0">&copy; 2026 MA Hasanuddin. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>