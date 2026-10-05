<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MA Hasanuddin - Portal Resmi Madrasah Aliyah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .hero-slider img {
            height: 450px;
            object-fit: cover;
        }

        .zig-zag-img {
            height: 280px;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Styling dasar link navigasi */
        .nav-link-custom {
            color: #333333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            position: relative;
            padding-bottom: 4px;
        }

        /* Efek pas kursor diarahkan (Hover - "Nyala") */
        .nav-link-custom:hover {
            color: #157347 !important;
        }

        /* Efek garis bawah kecil atau warna menyala pas menu itu lagi dibuka */
        .nav-link-custom.active {
            color: #157347 !important;
        }

        .nav-link-custom.active::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #157347;
        }
    </style>
</head>

<body class="bg-light">

    <!-- 1. HEADER & HOTBAR NAVIGASI -->
    <header class="bg-white shadow-sm sticky-top">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <!-- Logo Sekolah -->
            <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                <div class="bg-success text-white fw-bold px-3 py-2 rounded shadow-sm me-2">MA</div>
                <div>
                    <h5 class="mb-0 fw-bold text-dark">MA HASANUDDIN</h5>
                    <small class="text-muted" style="font-size: 11px;">Portal Informasi Madrasah</small>
                </div>
            </a>

            <!-- NAVBAR UTAMA -->
            <nav class="d-none d-md-flex align-items-center gap-4">
                <a href="{{ url('/') }}"
                    class="nav-link-custom {{ request()->is('/') ? 'active fw-bold' : '' }}">Beranda</a>
                <a href="{{ url('/berita') }}"
                    class="nav-link-custom {{ request()->is('berita*') ? 'active fw-bold' : '' }}">Berita</a>
                <a href="{{ url('/galeri') }}"
                    class="nav-link-custom {{ request()->is('galeri*') ? 'active fw-bold' : '' }}">Galeri</a>
                <a href="{{ url('/media-sosial') }}"
                    class="nav-link-custom {{ request()->is('media-sosial*') ? 'active fw-bold' : '' }}">Media
                    Sosial</a>

                <!-- MENU PROFIL (Kotak Hijau, Teks Kuning) -->
                <a href="{{ route('profil') }}"
                    class="px-3 py-2 rounded-3 bg-success text-warning fw-bold shadow-sm text-decoration-none {{ request()->routeIs('profil*') ? 'border border-warning' : '' }}">
                    <i class="bi bi-person-badge-fill me-1"></i> Profil Guru
                </a>
            </nav>
        </div>
    </header>

    <!-- 2. SLIDE PHOTO (BANNER SLIDER) -->
    <section class="container my-4">
        <div id="schoolSlider" class="carousel slide shadow rounded overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-inner hero-slider">
                @forelse($sliders as $key => $slider)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ Str::startsWith($slider->image, 'http') ? $slider->image : asset('storage/' . $slider->image) }}"
                            class="d-block w-100" alt="{{ $slider->title }}">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h3 class="fw-bold">{{ $slider->title }}</h3>
                            <p class="mb-0">{{ $slider->caption }}</p>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="https://picsum.photos/1200/500?random=1" class="d-block w-100" alt="Default Banner">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h3 class="fw-bold">Selamat Datang di MA Hasanuddin</h3>
                            <p class="mb-0">Pusat Pendidikan Unggul & Berkarakter</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#schoolSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#schoolSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- 3. SECTION ZIG-ZAG DINAMIS DARI DATABASE -->
    <section class="container my-5">
        @forelse($sections as $sec)
            @if($sec->position == 'left')
                <!-- Jika posisi gambar di kiri -->
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img src="{{ Str::startsWith($sec->image, 'http') ? $sec->image : asset('storage/' . $sec->image) }}"
                            class="w-100 zig-zag-img shadow-sm" alt="Gambar Konten">
                    </div>
                    <div class="col-md-6 ps-md-4">
                        @if(isset($sec->badge) && $sec->badge)<span class="badge bg-success mb-2">{{ $sec->badge }}</span>@endif
                        <h3 class="fw-bold mb-3">{{ $sec->title }}</h3>
                        <p class="text-muted">{!! $sec->content !!}</p>
                    </div>
                </div>
            @else
                <!-- Jika posisi gambar di kanan -->
                <div class="row align-items-center flex-md-row-reverse mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img src="{{ Str::startsWith($sec->image, 'http') ? $sec->image : asset('storage/' . $sec->image) }}"
                            class="w-100 zig-zag-img shadow-sm" alt="Gambar Konten">
                    </div>
                    <div class="col-md-6 pe-md-4">
                        @if(isset($sec->badge) && $sec->badge)<span
                        class="badge bg-info text-dark mb-2">{{ $sec->badge }}</span>@endif
                        <h3 class="fw-bold mb-3">{{ $sec->title }}</h3>
                        <p class="text-muted">{!! $sec->content !!}</p>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center py-4 text-muted">Belum ada konten profil/seksi yang ditambahkan dari panel admin.</div>
        @endforelse
    </section>

    <!-- 4. SECTION BERITA TERBARU -->
    <section class="bg-white py-5 shadow-sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-0">Berita & Informasi Terbaru</h3>
                    <p class="text-muted small mb-0">Ikuti perkembangan dan kegiatan terbaru seputar madrasah</p>
                </div>
                <a href="{{ url('/berita') }}" class="btn btn-success btn-sm">Laman Berita Sekolah &rarr;</a>
            </div>

            <div class="row">
                @forelse($news as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            @if($item->image)
                                <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                    class="card-img-top" style="height: 200px; object-fit: cover;" alt="Berita">
                            @endif
                            <div class="card-body">
                                <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>
                                    {{ $item->created_at->format('d M Y') }}</small>
                                <h5 class="card-title fw-bold mt-2 text-dark">{{ $item->title }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit(strip_tags($item->content), 90) }}</p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3">
                                <a href="#" class="btn btn-sm btn-outline-dark w-100">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        Belum ada berita yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. SECTION HIGHLIGHT MEDIA SOSIAL -->
    <section class="container my-5">
        <div class="text-center mb-4">
            <span class="badge bg-dark px-3 py-2 mb-2">Media Sosial Resmi</span>
            <h3 class="fw-bold">Kegiatan & Momen Terbaru</h3>
            <p class="text-muted small">Ikuti keseruan aktivitas madrasah melalui kanal sosial media kami</p>
        </div>

        <div class="row">
            @forelse($highlights as $hl)
                @php
                    $displayImage = null;

                    // 1. Cek apakah ada gambar custom hasil upload lokal admin
                    if ($hl->image) {
                        $displayImage = Str::startsWith($hl->image, 'http') ? $hl->image : asset('storage/' . $hl->image);
                    }
                    // 2. Jika tidak ada upload manual DAN platform YouTube, tarik thumbnail otomatis
                    elseif ($hl->platform == 'YouTube') {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $hl->url, $match);
                        if (isset($match[1])) {
                            $displayImage = "https://img.youtube.com/vi/{$match[1]}/hqdefault.jpg";
                        }
                    }
                @endphp

                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 bg-white rounded-4 overflow-hidden d-flex flex-column">

                        <!-- Tampilkan Gambar jika ada (baik upload custom maupun auto-YouTube) -->
                        @if($displayImage)
                            <div class="position-relative" style="height: 180px; background-color: #000;">
                                <img src="{{ $displayImage }}" alt="{{ $hl->title }}" class="w-100 h-100 object-fit-cover">
                                @if($hl->platform == 'YouTube')
                                    <span
                                        class="position-absolute top-50 start-50 translate-middle bg-danger text-white rounded-circle p-2 d-flex align-items-center justify-content-center shadow"
                                        style="width: 45px; height: 45px;">
                                        <i class="bi bi-play-fill fs-4"></i>
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-{{ $hl->platform == 'YouTube' ? 'danger' : ($hl->platform == 'TikTok' ? 'dark' : 'primary') }} text-white rounded-circle p-2 me-2 d-flex align-items-center justify-content-center"
                                    style="width: 35px; height: 35px;">
                                    <i
                                        class="bi bi-{{ $hl->platform == 'YouTube' ? 'youtube' : ($hl->platform == 'TikTok' ? 'tiktok' : 'instagram') }} fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 14px;">{{ $hl->platform }}</h6>
                                    <small class="text-muted" style="font-size: 10px;">MA Hasanuddin Official</small>
                                </div>
                            </div>

                            <h5 class="fw-bold text-dark fs-6 mb-3">{{ $hl->title }}</h5>

                            <div class="mt-auto pt-2">
                                <a href="{{ $hl->url }}" target="_blank"
                                    class="btn btn-outline-dark btn-sm w-100 rounded-pill">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> Tonton / Lihat Postingan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    Belum ada highlight media sosial yang diaktifkan oleh admin.
                </div>
            @endforelse
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1 fw-bold">MA HASANUDDIN</p>
            <small class="text-white-50">&copy; 2026 Madrasah Aliyah Hasanuddin. All Rights Reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>