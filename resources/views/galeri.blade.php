<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Dokumentasi - MA Hasanuddin</title>
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

        .card-highlight {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            background: #fff;
        }

        .gallery-card-item {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .gallery-card-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
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

    <!-- KONTEN UTAMA -->
    <div class="container my-5">

        <!-- BAGIAN ATAS: DESKRIPSI & HIGHLIGHT UTAMA (Dari Database Section) -->
        <div class="row g-4 mb-5">

            <!-- KOTAK KIRI: Pengenalan Galeri -->
            <div class="col-lg-7">
                <div
                    class="card card-highlight h-100 p-5 d-flex flex-column justify-content-center border-start border-success border-5">
                    <span class="badge bg-success mb-3 px-3 py-2 rounded-pill align-self-start">
                        <i class="bi bi-images me-1"></i> Dokumentasi Visual Madrasah
                    </span>
                    <h2 class="fw-bold text-success mb-3">Mengabadikan Setiap Momen & Perjalanan Bermakna</h2>
                    <p class="text-dark mb-4 lead fw-medium" style="font-size: 1.05rem; line-height: 1.6;">
                        Selamat datang di etalase visual MA Hasanuddin. Ruang digital ini merekam jejak keaktifan
                        siswa-siswi dalam kegiatan akademik, kreativitas ekstrakurikuler, hingga kebersamaan hangat di
                        lingkungan madrasah. Setiap potret menyimpan cerita dan semangat berprestasi kami.
                    </p>
                </div>
            </div>

            <!-- KOTAK KANAN: Highlight Utama (Mengambil Data dari Tabel Section) -->
            <div class="col-lg-5">
                <div class="card card-highlight h-100 p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success-subtle text-success fw-bold px-2 py-1"><i
                                    class="bi bi-star-fill text-warning me-1"></i> Highlight</span>
                            <small class="text-muted"
                                style="font-size: 0.75rem;">{{ isset($highlightSection) ? $highlightSection->created_at->format('d M Y') : '' }}</small>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 text-truncate">
                            {{ $highlightSection->title ?? 'Judul Section Kosong' }}
                        </h5>
                        <p class="small text-secondary mb-3 text-truncate">
                            {{ $highlightSection->content ?? 'Deskripsi section utama madrasah.' }}
                        </p>
                    </div>

                    <div class="ratio ratio-16x9 rounded-3 overflow-hidden bg-light shadow-sm">
                        @if(isset($highlightSection) && !empty($highlightSection->image))
                            <img src="{{ filter_var($highlightSection->image, FILTER_VALIDATE_URL) ? $highlightSection->image : asset('storage/' . $highlightSection->image) }}"
                                class="w-100 h-100 object-fit-cover" alt="Section Highlight">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                <i class="bi bi-image display-6"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- FILTER / SORTIR TAHUN -->
        <div
            class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 bg-white p-3 rounded-4 shadow-sm">
            <div class="fw-bold text-dark">
                <i class="bi bi-filter text-success me-1"></i> Filter Arsip Berdasarkan Tahun
            </div>
            <div class="btn-group shadow-sm filter-btn-group" role="group">
                <button type="button" class="btn btn-outline-success active btn-sm px-3"
                    data-filter="all">Semua</button>
                <button type="button" class="btn btn-outline-success btn-sm px-3" data-filter="2026">2026</button>
                <button type="button" class="btn btn-outline-success btn-sm px-3" data-filter="2025">2025</button>
            </div>
        </div>

        <!-- GRID FOTO DI BAWAH -->
        <div class="row g-4" id="galleryGrid">
            @forelse($galleries as $item)
                <div class="col-md-4 col-sm-6 gallery-item" data-year="{{ $item->created_at->format('Y') }}">
                    <div class="card gallery-card-item h-100 p-3">
                        <div class="ratio ratio-4x3 bg-light rounded-3 mb-3 overflow-hidden">
                            @if(!empty($item->image))
                                <img src="{{ filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : asset('storage/' . $item->image) }}"
                                    class="w-100 h-100 object-fit-cover" alt="{{ $item->title }}"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=MA+Hasanuddin'">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image display-5"></i>
                                </div>
                            @endif
                        </div>
                        <div class="text-center bg-light p-2 rounded-3 border border-light-subtle">
                            <span class="fw-bold text-dark d-block text-truncate"
                                style="font-size: 0.95rem;">{{ $item->title }}</span>
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Tahun
                                {{ $item->created_at->format('Y') }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada foto galeri yang diunggah.</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0 small text-white-50">&copy; 2026 Portal Resmi MA Hasanuddin. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS & Script Filter -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterButtons = document.querySelectorAll('.filter-btn-group button');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    galleryItems.forEach(item => {
                        const year = item.getAttribute('data-year');
                        if (filter === 'all' || year === filter) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>