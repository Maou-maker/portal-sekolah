<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Sosial Hub - MA Hasanuddin</title>
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

        .sidebar-link {
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: var(--light-green);
            border-left-color: var(--primary-green);
            color: var(--primary-green) !important;
            font-weight: bold;
        }

        .card-highlight {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .card-highlight:hover {
            transform: translateY(-5px);
        }

        /* Custom Brand Colors for Buttons */
        .btn-youtube {
            background-color: #ff0000;
            color: white;
            border: none;
        }

        .btn-youtube:hover {
            background-color: #cc0000;
            color: white;
        }

        .btn-instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            color: white;
            border: none;
        }

        .btn-instagram:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-tiktok {
            background-color: #010101;
            color: white;
            border: none;
        }

        .btn-tiktok:hover {
            background-color: #333333;
            color: white;
        }
    </style>
</head>

<body class="bg-light">

    <!-- HEADER / NAVBAR UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 38px;"
                    onerror="this.style.display='none'">
                <span>MA HASANUDDIN</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3 fw-semibold align-items-center">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('/berita') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('/galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('/media-sosial') }}">Media
                            Sosial</a></li>

                    <!-- MENU PROFIL (Kotak Putih, Teks Hijau) -->
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded-3 bg-white text-success fw-bold shadow-sm {{ request()->routeIs('profil*') ? 'border border-2 border-success' : '' }}"
                            href="{{ route('profil') }}">
                            <i class="bi bi-person-badge-fill me-1"></i> Profil Guru
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="container my-5">

        <!-- BAGIAN ATAS: LIST LINK MEDSOS & DESKRIPSI -->
        <div class="row g-4 mb-5">

            <!-- KOLOM KIRI: DAFTAR KANAL -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom rounded-top-4">
                        <h5 class="fw-bold mb-0 text-success"><i class="bi bi-share-fill me-2"></i> Kanal Resmi Kami
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group list-group-flush gap-2">
                            @forelse($socials as $soc)
                                <a href="{{ $soc->url }}" target="_blank"
                                    class="list-group-item list-group-item-action border rounded sidebar-link py-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        @if(strtolower($soc->platform) == 'youtube')
                                            <i class="bi bi-youtube fs-4 text-danger"></i>
                                        @elseif(strtolower($soc->platform) == 'instagram')
                                            <i class="bi bi-instagram fs-4" style="color: #e1306c;"></i>
                                        @elseif(strtolower($soc->platform) == 'tiktok')
                                            <i class="bi bi-tiktok fs-4 text-dark"></i>
                                        @else
                                            <i class="bi bi-globe fs-4 text-success"></i>
                                        @endif
                                        <div>
                                            <span class="fw-bold d-block text-dark">{{ $soc->title }}</span>
                                            <small class="text-muted text-uppercase"
                                                style="font-size: 0.75rem;">{{ $soc->platform }}</small>
                                        </div>
                                    </div>
                                    <i class="bi bi-chevron-right text-muted small"></i>
                                </a>
                            @empty
                                <p class="text-muted text-center py-4 small">Belum ada tautan media sosial terdaftar.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: DESKRIPSI UTAMA & TOMBOL UKURAN SEDANG -->
            <div class="col-lg-8">
                <div
                    class="card border-0 shadow-sm rounded-4 h-100 bg-white text-dark p-4 d-flex flex-column justify-content-center border-start border-success border-5">
                    <div class="p-3">
                        <span class="badge bg-success mb-2 px-3 py-2 rounded-pill">Pusat Informasi Digital</span>
                        <h2 class="fw-bold text-success mb-3">Terhubung dengan Aktivitas Madrasah Kami</h2>
                        <p class="text-dark mb-4 lead fw-medium" style="font-size: 1.05rem; line-height: 1.6;">
                            Selamat datang di Hub Media Sosial resmi MA Hasanuddin. Ikuti seluruh dokumentasi kegiatan
                            harian, pengumuman penting, karya siswa, serta video kajian dan ekstrakurikuler melalui
                            kanal digital kami di bawah ini.
                        </p>
                        <!-- Kumpulan Tombol Ukuran Sedang dengan Warna Brand Masing-Masing -->
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="https://www.youtube.com/@madrasahaliyahhasanuddin5382" target="_blank"
                                class="btn btn-youtube btn-sm fw-bold px-3 py-2">
                                <i class="bi bi-youtube me-1"></i> YouTube
                            </a>
                            <a href="https://www.instagram.com/madrasahaliyahhasanuddin/" target="_blank"
                                class="btn btn-instagram btn-sm fw-bold px-3 py-2">
                                <i class="bi bi-instagram me-1"></i> Instagram
                            </a>
                            <a href="https://www.tiktok.com/@mahasmediaofficial" target="_blank"
                                class="btn btn-tiktok btn-sm fw-bold px-3 py-2">
                                <i class="bi bi-tiktok me-1"></i> TikTok
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- BAGIAN BAWAH: FILTER & GRID KARTU KONTEN -->
        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1"><i class="bi bi-grid-fill text-success me-2"></i> Sorotan Postingan &
                    Video</h4>
                <p class="text-muted small mb-0">Konten pilihan terbaru dari berbagai platform media sosial MA
                    Hasanuddin.</p>
            </div>
            <!-- TOMBOL FILTER -->
            <div class="btn-group shadow-sm filter-btn-group" role="group">
                <button type="button" class="btn btn-outline-success active btn-sm px-3"
                    data-filter="all">Semua</button>
                <button type="button" class="btn btn-outline-success btn-sm px-3" data-filter="youtube">YouTube</button>
                <button type="button" class="btn btn-outline-success btn-sm px-3"
                    data-filter="instagram">Instagram</button>
                <button type="button" class="btn btn-outline-success btn-sm px-3" data-filter="tiktok">TikTok</button>
            </div>
        </div>

        <!-- GRID KARTU KONTEN -->
        <div class="row g-4" id="socialCardsGrid">
            @forelse($socials as $soc)
                @php
                    // Logika otomatis ekstrak thumbnail YouTube jika link berupa link video/watch
                    $displayImage = $soc->image;
                    if (strtolower($soc->platform) == 'youtube' && empty($displayImage)) {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $soc->url, $match);
                        if (isset($match[1])) {
                            $displayImage = 'https://img.youtube.com/vi/' . $match[1] . '/hqdefault.jpg';
                        }
                    }
                @endphp
                <div class="col-md-4 col-sm-6 social-card-item" data-platform="{{ strtolower($soc->platform) }}">
                    <div class="card card-highlight h-100 bg-white p-3">
                        <!-- THUMBNAIL GAMBAR -->
                        <div class="ratio ratio-16x9 bg-light rounded-3 mb-3 overflow-hidden">
                            @if(!empty($displayImage))
                                <img src="{{ filter_var($displayImage, FILTER_VALIDATE_URL) ? $displayImage : asset('storage/' . $displayImage) }}"
                                    class="w-100 h-100 object-fit-cover" alt="{{ $soc->title }}"
                                    onerror="this.src='https://via.placeholder.com/400x225?text=MA+Hasanuddin'">
                            @else
                                <div
                                    class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary text-white">
                                    <i class="bi bi-image display-6"></i>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2">
                            @if(strtolower($soc->platform) == 'youtube')
                                <span class="badge bg-danger"><i class="bi bi-youtube me-1"></i> YouTube</span>
                            @elseif(strtolower($soc->platform) == 'instagram')
                                <span class="badge" style="background: #e1306c;"><i class="bi bi-instagram me-1"></i>
                                    Instagram</span>
                            @elseif(strtolower($soc->platform) == 'tiktok')
                                <span class="badge bg-dark"><i class="bi bi-tiktok me-1"></i> TikTok</span>
                            @else
                                <span class="badge bg-success"><i class="bi bi-globe me-1"></i> {{ $soc->platform }}</span>
                            @endif
                            <small class="text-muted" style="font-size: 0.75rem;">MA Hasanuddin Official</small>
                        </div>

                        <h6 class="fw-bold text-dark text-truncate mb-2">{{ $soc->title }}</h6>
                        <p class="small text-secondary mb-3 flex-grow-1">Dokumentasi dan sorotan kegiatan resmi
                            madrasah.</p>

                        <a href="{{ $soc->url }}" target="_blank"
                            class="btn btn-sm btn-outline-success fw-bold w-100 mt-auto">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Tonton / Lihat Postingan
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Belum ada sorotan konten media sosial.</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0 small text-white-50">&copy; 2026 Portal Resmi MA Hasanuddin. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS & Script Filter -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterButtons = document.querySelectorAll('.filter-btn-group button');
            const socialCards = document.querySelectorAll('.social-card-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    socialCards.forEach(card => {
                        const platform = card.getAttribute('data-platform');
                        if (filterValue === 'all' || platform === filterValue) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>