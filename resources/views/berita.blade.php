<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Informasi - MA Hasanuddin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #157347;
            --light-green: #d1e7dd;
        }

        .navbar-custom {
            background-color: var(--primary-green);
        }

        .news-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background: #fff;
            overflow: hidden;
        }

        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .news-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 200px;
        }

        .sidebar-popular {
            position: sticky;
            top: 2rem;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- HEADER / NAVBAR UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 38px;"
                    onerror="this.style.display='none'">
                <span>MA HASANUDDIN</span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-4 fw-semibold">
                <a class="text-white text-decoration-none" href="{{ url('/') }}">Beranda</a>
                <a class="text-white text-decoration-none" href="{{ url('/berita') }}">Berita</a>
                <a class="text-white text-decoration-none" href="{{ url('/galeri') }}">Galeri</a>
                <a class="text-white text-decoration-none" href="{{ url('/media-sosial') }}">Media Sosial</a>

                <!-- MENU PROFIL (Kotak Putih, Teks Hijau) -->
                <a href="{{ route('profil') }}"
                    class="px-3 py-2 rounded-3 bg-white text-success fw-bold shadow-sm text-decoration-none {{ request()->routeIs('profil*') ? 'border border-2 border-success' : '' }}">
                    <i class="bi bi-person-badge-fill me-1"></i> Profil Guru
                </a>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA BERITA (Sesuai Desain Canva: Kiri List Berita, Kanan Berita Populer) -->
    <div class="container my-5">
        <div class="row g-4">

            <!-- KOLOM KIRI: LIST BERITA UTAMA -->
            <div class="col-lg-8">
                <div class="mb-4">
                    <span class="badge bg-success mb-2 px-3 py-2 rounded-pill"><i class="bi bi-newspaper me-1"></i>
                        Informasi Terkini</span>
                    <h2 class="fw-bold text-success">Berita & Pengumuman Madrasah</h2>
                    <p class="text-muted small">Ikuti perkembangan, agenda kegiatan, dan informasi resmi seputar
                        lingkungan MA Hasanuddin.</p>
                </div>

                <div class="d-flex flex-column gap-4">
                    @forelse($news as $item)
                        <div class="card news-card">
                            <div class="row g-0 h-100">
                                <!-- Photo Berita di Kiri -->
                                <div class="col-md-4 bg-light">
                                    @if(!empty($item->image))
                                        <img src="{{ filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : asset('storage/' . $item->image) }}"
                                            class="news-img" alt="{{ $item->title }}"
                                            onerror="this.src='https://via.placeholder.com/400x300?text=MA+Hasanuddin'">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary-subtle"
                                            style="min-height: 180px;">
                                            <i class="bi bi-image display-5"></i>
                                        </div>
                                    @endif
                                </div>
                                <!-- Judul, Isi, & Tombol di Kanan -->
                                <div class="col-md-8">
                                    <div class="card-body p-4 d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <span class="badge bg-success-subtle text-success"
                                                    style="font-size: 0.75rem;">
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ $item->created_at->format('d M Y') }}
                                                </span>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-2" style="font-size: 1.2rem;">{{ $item->title }}
                                            </h4>
                                            <p class="text-secondary small mb-3" style="line-height: 1.5;">
                                                {{ Str::limit(strip_tags($item->content), 120) }}
                                            </p>
                                        </div>
                                        <div>
                                            <!-- Tombol Baca Selengkapnya -->
                                            <a href="{{ url('/berita/' . ($item->id ?? 1)) }}"
                                                class="btn btn-outline-success btn-sm fw-bold px-3">
                                                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                            <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
                            <h5 class="fw-bold text-dark">Belum Ada Berita</h5>
                            <p class="text-muted small mb-0">Admin belum mempublikasikan artikel atau pengumuman berita.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- KOLOM KANAN: BERITA POPULER (Sidebar Sesuai Desain Canva) -->
            <div class="col-lg-4">
                <div class="sidebar-popular">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom">
                            <i class="bi bi-fire text-danger me-2"></i> Berita Populer
                        </h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach($news->take(3) as $popular)
                                <div class="d-flex gap-3 align-items-center pb-3 border-bottom border-light">
                                    <div class="flex-shrink-0 rounded-3 overflow-hidden bg-light"
                                        style="width: 60px; height: 60px;">
                                        @if(!empty($popular->image))
                                            <img src="{{ filter_var($popular->image, FILTER_VALIDATE_URL) ? $popular->image : asset('storage/' . $popular->image) }}"
                                                class="w-100 h-100 object-fit-cover" alt="Thumb">
                                        @else
                                            <div
                                                class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.9rem;">
                                            <a href="{{ url('/berita/' . $popular->id) }}"
                                                class="text-decoration-none text-dark stretched-link">{{ $popular->title }}</a>
                                        </h6>
                                        <small class="text-muted" style="font-size: 0.75rem;"><i
                                                class="bi bi-clock me-1"></i>
                                            {{ $popular->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0 small text-white-50">&copy; 2026 Portal Resmi MA Hasanuddin. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>