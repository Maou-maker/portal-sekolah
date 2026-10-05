<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsItem->title ?? 'Detail Berita' }} - MA Hasanuddin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #157347;
        }

        .navbar-custom {
            background-color: var(--primary-green);
        }

        .btn-custom-back {
            background-color: #ff4d4d;
            color: white;
            border: none;
            font-weight: 600;
        }

        .btn-custom-back:hover {
            background-color: #e03e3e;
            color: white;
        }

        .btn-custom-next {
            background-color: #ffc107;
            color: #000;
            border: none;
            font-weight: 600;
        }

        .btn-custom-next:hover {
            background-color: #e0a800;
        }

        .main-content-box {
            background: #fff;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2c3e50;
        }

        .recommendation-card {
            background-color: #ff6b35;
            /* Nuansa oranye sesuai desain canva */
            color: white;
            border: none;
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .recommendation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }
    </style>
</head>

<body class="bg-light">

    <!-- NAVBAR UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-white" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 38px;"
                    onerror="this.style.display='none'">
                <span>MA HASANUDDIN</span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-4 fw-semibold">
                <a class="text-white text-decoration-none" href="{{ url('/') }}">Beranda</a>
                <a class="text-warning text-decoration-none" href="{{ url('/berita') }}">Berita</a>
                <a class="text-white text-decoration-none" href="{{ url('/galeri') }}">Galeri</a>
                <a class="text-white text-decoration-none" href="{{ url('/media-sosial') }}">Media Sosial</a>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="container my-5">
        <div class="row">

            <!-- KOLOM KIRI (NAVIGASI ATAS: Balik & Selanjutnya) -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="d-flex flex-column gap-3 sticky-top" style="top: 2rem;">
                    <!-- Tombol Balik ke Laman Berita -->
                    <a href="{{ url('/berita') }}"
                        class="btn btn-custom-back py-2 px-3 rounded-pill shadow-sm text-start d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-arrow-left me-2"></i> Balik ke Berita</span>
                        <i class="bi bi-newspaper"></i>
                    </a>

                    <!-- Tombol Berita Selanjutnya (Opsional mengambil berita ID berikutnya) -->
                    @php
                        $nextNews = \App\Models\News::where('id', '>', $newsItem->id)->orderBy('id', 'asc')->first();
                        if (!$nextNews) {
                            $nextNews = \App\Models\News::orderBy('id', 'asc')->first(); // Kalau habis, balik ke berita pertama
                        }
                    @endphp

                    @if($nextNews && $nextNews->id != $newsItem->id)
                        <a href="{{ url('/berita/' . $nextNews->id) }}"
                            class="btn btn-custom-next py-2 px-3 rounded-pill shadow-sm text-start d-flex align-items-center justify-content-between">
                            <span class="text-truncate" style="max-width: 140px;"><i class="bi bi-arrow-right me-1"></i>
                                {{ $nextNews->title }}</span>
                            <i class="bi bi-skip-forward-fill"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- KOLOM KANAN (KOTAK UTAMA: ISI BERITA & THUMBNAIL) -->
            <div class="col-lg-9">
                <div class="card main-content-box p-4 p-md-5 mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-success px-3 py-2 rounded-pill"><i class="bi bi-tag-fill me-1"></i>
                            Informasi Madrasah</span>
                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>
                            {{ $newsItem->created_at->format('d M Y') }}</small>
                    </div>

                    <h1 class="fw-bold text-dark mb-4" style="line-height: 1.3;">{{ $newsItem->title }}</h1>

                    <!-- Thumbnail / Foto Berita Utama -->
                    @if(!empty($newsItem->image))
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden mb-4 shadow-sm bg-light">
                            <img src="{{ filter_var($newsItem->image, FILTER_VALIDATE_URL) ? $newsItem->image : asset('storage/' . $newsItem->image) }}"
                                class="w-100 h-100 object-fit-cover" alt="Thumbnail Berita">
                        </div>
                    @endif

                    <!-- Isi Berita -->
                    <div class="article-body">
                        {!! $newsItem->content !!}
                    </div>
                </div>
            </div>

        </div>

        <!-- BAGIAN BAWAH: 3 KOTAK LIST BERITA (Rekomendasi Lainnya) -->
        <div class="mt-4">
            <h4 class="fw-bold text-dark mb-4 text-center">
                <i class="bi bi-grid-fill text-success me-2"></i> Berita & Informasi Lainnya
            </h4>

            <div class="row g-4">
                @php
                    $otherNews = \App\Models\News::where('id', '!=', $newsItem->id)->latest()->take(3)->get();
                @endphp

                @forelse($otherNews as $other)
                    <div class="col-md-4">
                        <div
                            class="card recommendation-card h-100 p-3 shadow-sm d-flex flex-column justify-content-between">
                            <div>
                                <div class="ratio ratio-16x9 rounded-3 overflow-hidden mb-3 bg-white">
                                    @if(!empty($other->image))
                                        <img src="{{ filter_var($other->image, FILTER_VALIDATE_URL) ? $other->image : asset('storage/' . $other->image) }}"
                                            class="w-100 h-100 object-fit-cover" alt="Other News">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted"><i
                                                class="bi bi-image"></i></div>
                                    @endif
                                </div>
                                <h5 class="fw-bold text-white mb-2 text-truncate" style="font-size: 1.05rem;">
                                    {{ $other->title }}
                                </h5>
                                <p class="text-white-50 small mb-3" style="font-size: 0.9rem;">
                                    {{ Str::limit($other->content, 75) }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ url('/berita/' . $other->id) }}"
                                    class="btn btn-light btn-sm fw-bold text-dark w-100 rounded-pill">
                                    Baca Berita <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Belum ada berita lainnya.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0 small text-white-50">&copy; 2026 Portal Resmi MA Hasanuddin. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>