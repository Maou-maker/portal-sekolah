<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - MA Hasanuddin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .preview-card {
            max-height: 220px;
            overflow-y: auto;
        }

        .dynamic-section {
            min-height: 550px;
            background: #ffffff;
            border-radius: 1rem;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body class="bg-light">

    <!-- NAVBAR HEADER ADMIN -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-success" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shield-lock-fill me-2"></i> ADMIN MA HASANUDDIN
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-globe me-1"></i> Masuk Web Utama
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA BAGIAN ATAS -->
    <div class="container-fluid px-4 my-4">
        <div class="row g-4">

            <!-- KOLOM KIRI: KELOLA MODUL -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4">
                        <h5 class="fw-bold mb-0"><i class="bi bi-grid-fill me-2"></i> Kelola Modul</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group list-group-flush gap-2">
                            <a href="{{ route('admin.dashboard', ['tab' => 'news']) }}"
                                class="list-group-item list-group-item-action border rounded d-flex justify-content-between align-items-center py-3 {{ $activeTab == 'news' ? 'active bg-success text-white border-success' : '' }}">
                                <span><i class="bi bi-newspaper me-2 text-success"></i> Kelola Berita Madrasah</span>
                                <span
                                    class="badge {{ $activeTab == 'news' ? 'bg-light text-dark' : 'bg-success' }} rounded-pill">{{ $totalNews }}
                                    Berita</span>
                            </a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'galleries']) }}"
                                class="list-group-item list-group-item-action border rounded d-flex justify-content-between align-items-center py-3 {{ $activeTab == 'galleries' ? 'active bg-info text-dark border-info' : '' }}">
                                <span><i class="bi bi-images me-2 text-info"></i> Kelola Galeri Sekolah</span>
                                <span
                                    class="badge {{ $activeTab == 'galleries' ? 'bg-dark text-white' : 'bg-info text-dark' }} rounded-pill">{{ $totalGalleries }}
                                    Foto</span>
                            </a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'sliders']) }}"
                                class="list-group-item list-group-item-action border rounded d-flex justify-content-between align-items-center py-3 {{ $activeTab == 'sliders' ? 'active bg-warning text-dark border-warning' : '' }}">
                                <span><i class="bi bi-sliders me-2 text-warning"></i> Kelola Banner Slider</span>
                                <span class="badge bg-warning text-dark rounded-pill">{{ $totalSliders }} Banner</span>
                            </a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'socials']) }}"
                                class="list-group-item list-group-item-action border rounded d-flex justify-content-between align-items-center py-3 {{ $activeTab == 'socials' ? 'active bg-secondary text-white border-secondary' : '' }}">
                                <span><i class="bi bi-share me-2 text-secondary"></i> Kelola Tautan Media Sosial</span>
                                <span class="badge bg-secondary rounded-pill">{{ $totalSocials }} Link</span>
                            </a>
                            <a href="{{ route('admin.dashboard', ['tab' => 'sections']) }}"
                                class="list-group-item list-group-item-action border rounded d-flex justify-content-between align-items-center py-3 {{ $activeTab == 'sections' ? 'active bg-primary text-white' : '' }}">
                                <span><i class="bi bi-layout-text-window-reverse me-2 text-primary"></i> Kelola Konten &
                                    Posisi Landing</span>
                                <span class="badge bg-primary rounded-pill">Edit Profil</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: WIDGET PREVIEW REALTIME -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-warning text-dark py-3 rounded-top-4">
                        <h5 class="fw-bold mb-0"><i class="bi bi-eye-fill me-2"></i> Ringkasan Konten</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card bg-white border shadow-sm h-100">
                                    <div class="card-header bg-light py-2 fw-bold text-success small"><i
                                            class="bi bi-newspaper"></i> Berita Terbaru</div>
                                    <div class="card-body p-2 preview-card">
                                        <ul class="list-unstyled mb-0 small">
                                            @forelse($latestNews as $n)
                                                <li class="mb-2 border-bottom pb-1"><span
                                                        class="fw-bold text-dark d-block text-truncate">{{ $n->title }}</span>
                                                </li>
                                            @empty
                                                <li class="text-muted text-center py-2 small">Belum ada berita.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-white border shadow-sm h-100">
                                    <div class="card-header bg-light py-2 fw-bold text-warning small"><i
                                            class="bi bi-sliders"></i> Banner Slider Aktif</div>
                                    <div class="card-body p-2 preview-card">
                                        <ul class="list-unstyled mb-0 small">
                                            @forelse($latestSliders as $s)
                                                <li class="mb-2 border-bottom pb-1 d-flex align-items-center gap-2">
                                                    <img src="{{ asset('storage/' . $s->image) }}" class="rounded"
                                                        style="width: 30px; height: 20px; object-fit: cover;">
                                                    <span class="text-truncate">{{ $s->title }}</span>
                                                </li>
                                            @empty
                                                <li class="text-muted text-center py-2 small">Belum ada slider.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-white border shadow-sm h-100">
                                    <div class="card-header bg-light py-2 fw-bold text-info small"><i
                                            class="bi bi-images"></i> Galeri Terbaru</div>
                                    <div class="card-body p-2">
                                        <div class="row g-1">
                                            @forelse($latestGalleries as $g)
                                                <div class="col-3"><img src="{{ asset('storage/' . $g->image) }}"
                                                        class="rounded w-100" style="height: 40px; object-fit: cover;">
                                                </div>
                                            @empty
                                                <div class="col-12 text-muted text-center py-1 small">Kosong.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-white border shadow-sm h-100">
                                    <div class="card-header bg-light py-2 fw-bold text-secondary small"><i
                                            class="bi bi-share"></i> Tautan Medsos</div>
                                    <div class="card-body p-2 preview-card">
                                        <ul class="list-unstyled mb-0 small">
                                            @forelse($latestSocials as $soc)
                                                <li class="mb-2 border-bottom pb-1 d-flex justify-content-between">
                                                    <span class="fw-bold text-dark">{{ $soc->platform }}</span>
                                                    <a href="{{ $soc->url }}" target="_blank"
                                                        class="text-decoration-none">Buka</a>
                                                </li>
                                            @empty
                                                <li class="text-muted text-center py-1 small">Kosong.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================================================================= -->
        <!-- PANEL MANAJEMEN CRUD UTAMA -->
        <!-- ================================================================= -->
        <div class="row mt-4" id="crud-main-section">
            <div class="col-12">
                <div class="dynamic-section shadow-sm p-4">
                    @if($activeTab == 'preview')
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <div>
                                <span class="badge bg-success">Preview WEB</span>
                                <h4 class="fw-bold text-dark mt-1 mb-0"><i class="bi bi-laptop me-2"></i> Tampilan Beranda
                                    Asli</h4>
                            </div>
                            <span class="text-muted small"><i class="bi bi-info-circle me-1"></i> Klik menu modul di atas
                                untuk mulai mengelola data</span>
                        </div>
                        <div class="rounded-4 overflow-hidden border shadow-sm bg-white"
                            style="height: 500px; position: relative;">
                            <iframe src="{{ route('home') }}" class="w-100 h-100 border-0"></iframe>
                        </div>
                    @else
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                            <div>
                                <span class="badge bg-primary text-uppercase">{{ $activeTab }} Management</span>
                                <h4 class="fw-bold text-dark mt-1 mb-0">Kelola Data {{ ucfirst($activeTab) }}</h4>
                            </div>
                            <a href="{{ route('admin.dashboard') }}#crud-main-section"
                                class="btn btn-outline-danger btn-sm fw-bold px-3">
                                <i class="bi bi-x-lg me-1"></i>Tutup / Kembali
                            </a>
                        </div>

                        <!-- 1. KELOLA BERITA -->
                        @if($activeTab == 'news')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-muted mb-0">Daftar Berita Madrasah</h6>
                                <a href="{{ route('news.create') }}" class="btn btn-success btn-sm"><i
                                        class="bi bi-plus-lg"></i> Tambah Berita Baru</a>
                            </div>
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">Gambar</th>
                                        <th width="50%">Judul Berita</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($newsList as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" class="rounded"
                                                        style="width: 60px; height: 40px; object-fit: cover;">
                                                @else
                                                    <span class="badge bg-secondary text-light" style="font-size: 10px;">Tidak Ada
                                                        Foto</span>
                                                @endif
                                            </td>
                                            <td class="fw-bold">{{ $item->title }}</td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                                        class="bi bi-pencil"></i></a>
                                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Belum ada data berita.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- 2. KELOLA GALERI -->
                        @elseif($activeTab == 'galleries')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-muted mb-0">Daftar Foto Galeri</h6>
                                <button type="button" class="btn btn-info btn-sm text-dark fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#createGalleryModal">
                                    <i class="bi bi-plus-lg"></i> Upload Foto Baru
                                </button>
                            </div>
                            <div class="row g-3">
                                @forelse($galleryList as $g)
                                    <div class="col-md-3">
                                        <div class="card border shadow-sm p-2 position-relative">
                                            <img src="{{ asset('storage/' . $g->image) }}" class="rounded w-100"
                                                style="height: 120px; object-fit: cover;">
                                            <span class="small fw-bold text-truncate mt-2 d-block">{{ $g->title }}</span>
                                            <div class="d-flex justify-content-between mt-2">
                                                <button type="button" class="btn btn-warning btn-sm w-50 me-1"
                                                    data-bs-toggle="modal" data-bs-target="#editGalleryModal{{ $g->id }}"><i
                                                        class="bi bi-pencil"></i></button>
                                                <form action="{{ route('galleries.destroy', $g->id) }}" method="POST" class="w-50"
                                                    onsubmit="return confirm('Hapus foto ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted py-4">Belum ada foto galeri.</div>
                                @endforelse
                            </div>

                            <!-- 3. KELOLA SLIDER -->
                            <!-- 3. KELOLA SLIDER -->
                        @elseif($activeTab == 'sliders')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-muted mb-0">Daftar Banner Slider</h6>
                                <button type="button" class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#createSliderModal">
                                    <i class="bi bi-plus-lg"></i> Tambah Slider
                                </button>
                            </div>
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Banner</th>
                                        <th>Judul & Caption</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sliderList as $s)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/' . $s->image) }}" class="rounded"
                                                    style="width: 60px; height: 35px; object-fit: cover;"></td>
                                            <td>
                                                <div class="fw-bold">{{ $s->title }}</div>
                                                <small class="text-muted text-truncate d-block"
                                                    style="max-width: 350px;">{{ $s->caption ?? '-' }}</small>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editSliderModal{{ $s->id }}"><i
                                                        class="bi bi-pencil"></i></button>
                                                <form action="{{ route('sliders.destroy', $s->id) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Hapus slider ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- MODAL EDIT SLIDER -->
                                        <div class="modal fade" id="editSliderModal{{ $s->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow rounded-4">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title fw-bold">Edit Banner Slider</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('sliders.update', $s->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf @method('PUT')
                                                        <div class="modal-body p-4 text-start">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Judul Banner</label>
                                                                <input type="text" name="title" class="form-control"
                                                                    value="{{ $s->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Caption (Opsional)</label>
                                                                <input type="text" name="caption" class="form-control"
                                                                    value="{{ $s->caption }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                                                                <input type="file" name="image" class="form-control"
                                                                    accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light border-0">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-warning btn-sm fw-bold">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada slider.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- 4. KELOLA MEDIA SOSIAL -->
                            <!-- 4. KELOLA MEDIA SOSIAL -->
                        @elseif($activeTab == 'socials')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-muted mb-0">Daftar Media Sosial & Highlight</h6>
                                <button type="button" class="btn btn-secondary btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#createSocialModal">
                                    <i class="bi bi-plus-lg"></i> Tambah Tautan Medsos
                                </button>
                            </div>
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">Thumbnail</th>
                                        <th width="15%">Platform</th>
                                        <th width="30%">Judul / Link</th>
                                        <th width="10%">Highlight</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($socialList as $soc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                    $thumb = null;
                                                    if ($soc->image) {
                                                        $thumb = Str::startsWith($soc->image, 'http') ? $soc->image : asset('storage/' . $soc->image);
                                                    } elseif ($soc->platform == 'YouTube') {
                                                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $soc->url, $match);
                                                        if (isset($match[1])) {
                                                            $thumb = "https://img.youtube.com/vi/{$match[1]}/hqdefault.jpg";
                                                        }
                                                    }
                                                @endphp

                                                @if($thumb)
                                                    <img src="{{ $thumb }}" alt="Thumbnail" class="rounded shadow-sm"
                                                        style="width: 60px; height: 40px; object-fit: cover;">
                                                @else
                                                    <span class="badge bg-secondary text-light" style="font-size: 10px;">Tidak Ada
                                                        Foto</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-dark">{{ $soc->platform }}</span></td>
                                            <td>
                                                <div class="fw-bold">{{ $soc->title }}</div>
                                                <small class="text-muted">{{ $soc->url }}</small>
                                            </td>
                                            <td>{!! $soc->is_highlight ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' !!}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editSocialModal{{ $soc->id }}"><i
                                                        class="bi bi-pencil"></i></button>
                                                <form action="{{ route('socials.destroy', $soc->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Hapus tautan ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- MODAL EDIT MEDSOS -->
                                        <div class="modal fade" id="editSocialModal{{ $soc->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow rounded-4">
                                                    <div class="modal-header bg-secondary text-white">
                                                        <h5 class="modal-title fw-bold"><i class="bi bi-share me-2"></i> Edit Media
                                                            Sosial</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('socials.update', $soc->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf @method('PUT')
                                                        <div class="modal-body p-4 text-start">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Platform</label>
                                                                <select name="platform" class="form-select" required>
                                                                    <option value="YouTube" {{ $soc->platform == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                                                                    <option value="TikTok" {{ $soc->platform == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                                                                    <option value="Instagram" {{ $soc->platform == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Judul / Keterangan</label>
                                                                <input type="text" name="title" class="form-control"
                                                                    value="{{ $soc->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Ganti Thumbnail Custom
                                                                    (Opsional)</label>
                                                                <input type="file" name="image" class="form-control"
                                                                    accept="image/*">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">URL / Link</label>
                                                                <input type="url" name="url" class="form-control"
                                                                    value="{{ $soc->url }}" required>
                                                            </div>
                                                            <div class="mb-3 form-check">
                                                                <input type="checkbox" name="is_highlight" value="1"
                                                                    class="form-check-input" id="editHighlight{{ $soc->id }}" {{ $soc->is_highlight ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bold"
                                                                    for="editHighlight{{ $soc->id }}">Jadikan Highlight
                                                                    Utama</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light border-0">
                                                            <button type="button" class="btn btn-secondary btn-sm px-3"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-secondary btn-sm px-3 fw-bold">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Belum ada media sosial.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- 5. KELOLA SECTIONS -->
                        @elseif($activeTab == 'sections')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-muted mb-0">Daftar Konten & Narasi Landing Page</h6>
                                <a href="{{ route('sections.create') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-plus-lg"></i> Tambah Section Baru</a>
                            </div>
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Judul Bagian</th>
                                        <th>Isi Konten Singkat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sectionList as $sec)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bold">{{ $sec->title }}</td>
                                            <td><span class="text-muted text-truncate d-inline-block"
                                                    style="max-width: 250px;">{{ Str::limit(strip_tags($sec->content), 60) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('sections.edit', $sec->id) }}" class="btn btn-warning btn-sm"><i
                                                        class="bi bi-pencil"></i></a>
                                                <form action="{{ route('sections.destroy', $sec->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Hapus section ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada data konten section.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @endif
                    @endif
                </div>
            </div>
        </div>


        <!-- ================================================================= -->
        <!-- PANEL KHUSUS EDITOR PROFIL -->
        <!-- ================================================================= -->
        <div class="row mt-5 mb-5" id="profile-editor-section">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div
                        class="card-header bg-success text-warning py-3 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0"><i class="bi bi-person-badge-fill me-2"></i> Profil Madrasah</h5>
                        <span class="badge bg-warning text-dark fw-bold px-3 py-2">Editor</span>
                    </div>

                    <div class="card-body bg-light p-4">
                        <div class="row g-3">
                            <!-- SIDEBAR KIRI (Menu Sub-Profil) -->
                            <div class="col-md-3">
                                <div class="list-group shadow-sm rounded-4 overflow-hidden border">
                                    <a href="#editor-guru" data-bs-toggle="list"
                                        class="list-group-item list-group-item-action fw-bold active bg-warning text-dark border-warning py-3">
                                        <i class="bi bi-people-fill me-2"></i> Profil Guru & Pimpinan
                                    </a>
                                    <a href="#editor-visi" data-bs-toggle="list"
                                        class="list-group-item list-group-item-action fw-bold py-3">
                                        <i class="bi bi-bullseye me-2"></i> Visi & Misi
                                    </a>
                                    <a href="#editor-program" data-bs-toggle="list"
                                        class="list-group-item list-group-item-action fw-bold py-3">
                                        <i class="bi bi-gear-wide-connected me-2"></i> Program Unggulan
                                    </a>
                                    <a href="#editor-event" data-bs-toggle="list"
                                        class="list-group-item list-group-item-action fw-bold py-3">
                                        <i class="bi bi-calendar-event me-2"></i> Kegiatan Event Tahunan
                                    </a>
                                </div>
                            </div>

                            <!-- AREA KANAN (Tampilan Editor Konten) -->
                            <div class="col-md-9">
                                <div class="tab-content p-4 bg-white border rounded-4 shadow-sm"
                                    style="min-height: 480px;">

                                    <!-- 1. EDITOR GURU & PIMPINAN (FOTO DIPERBESAR) -->
                                    <div class="tab-pane fade show active" id="editor-guru">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fw-bold text-success mb-0">Kelola Data Guru & Pimpinan</h5>
                                            <button type="button" class="btn btn-success btn-sm fw-bold"
                                                data-bs-toggle="modal" data-bs-target="#modalTambahGuru">
                                                <i class="bi bi-plus-lg"></i> Tambah Guru
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle small">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th width="15%">Foto</th>
                                                        <th>Nama & NIP</th>
                                                        <th>Jabatan</th>
                                                        <th>Role</th>
                                                        <th class="text-center" width="15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $teachersList = \App\Models\ProfileTeacher::all(); @endphp
                                                    @forelse($teachersList as $t)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ $t->photo ? asset('storage/' . $t->photo) : 'https://via.placeholder.com/60' }}"
                                                                    class="rounded shadow-sm"
                                                                    style="width: 55px; height: 55px; object-fit: cover;">
                                                            </td>
                                                            <td>
                                                                <span class="fw-bold d-block">{{ $t->name }}</span>
                                                                <span class="text-muted"
                                                                    style="font-size: 11px;">{{ $t->nip ?? '-' }}</span>
                                                            </td>
                                                            <td>{{ $t->position }}</td>
                                                            <td><span
                                                                    class="badge {{ $t->role == 'headmaster' ? 'bg-success' : ($t->role == 'foundation_head' ? 'bg-dark' : 'bg-secondary') }}">{{ ucfirst($t->role) }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm py-0 px-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditGuru{{ $t->id }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                <form
                                                                    action="{{ route('profile.teacher.destroy', $t->id) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Hapus data guru ini?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm py-0 px-1"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <!-- MODAL EDIT GURU -->
                                                        <div class="modal fade" id="modalEditGuru{{ $t->id }}" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-0 shadow rounded-4">
                                                                    <div class="modal-header bg-warning text-dark">
                                                                        <h5 class="modal-title fw-bold">Edit Guru / Pimpinan
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('profile.teacher.update', $t->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf @method('PUT')
                                                                        <div class="modal-body p-4 text-start">
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Nama
                                                                                    Lengkap & Gelar</label>
                                                                                <input type="text" name="name"
                                                                                    class="form-control"
                                                                                    value="{{ $t->name }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">NIP /
                                                                                    NIY</label>
                                                                                <input type="text" name="nip"
                                                                                    class="form-control"
                                                                                    value="{{ $t->nip }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label fw-bold">Jabatan</label>
                                                                                <input type="text" name="position"
                                                                                    class="form-control"
                                                                                    value="{{ $t->position }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Peran
                                                                                    (Role)</label>
                                                                                <select name="role" class="form-select"
                                                                                    required>
                                                                                    <option value="teacher" {{ $t->role == 'teacher' ? 'selected' : '' }}>Guru Biasa</option>
                                                                                    <option value="headmaster" {{ $t->role == 'headmaster' ? 'selected' : '' }}>Kepala Sekolah</option>
                                                                                    <option value="foundation_head" {{ $t->role == 'foundation_head' ? 'selected' : '' }}>Kepala Yayasan
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Jenis
                                                                                    Kelamin</label>
                                                                                <select name="gender" class="form-select"
                                                                                    required>
                                                                                    <option value="L" {{ $t->gender == 'L' ? 'selected' : '' }}>Laki-laki
                                                                                    </option>
                                                                                    <option value="P" {{ $t->gender == 'P' ? 'selected' : '' }}>Perempuan
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Ganti Foto
                                                                                    (Opsional)</label>
                                                                                <input type="file" name="photo"
                                                                                    class="form-control" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-light border-0">
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm fw-bold">Simpan
                                                                                Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted py-3">Belum ada
                                                                data guru.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- 2. EDITOR VISI MISI -->
                                    <div class="tab-pane fade" id="editor-visi">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fw-bold text-success mb-0">Kelola Visi & Misi</h5>
                                            <button type="button" class="btn btn-success btn-sm fw-bold"
                                                data-bs-toggle="modal" data-bs-target="#modalTambahVisi">
                                                <i class="bi bi-plus-lg"></i> Tambah Visi/Misi
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle small">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th width="15%">Tipe</th>
                                                        <th>Konten Narasi</th>
                                                        <th width="15%" class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $visionsList = \App\Models\ProfileVision::all(); @endphp
                                                    @forelse($visionsList as $v)
                                                        <tr>
                                                            <td><span
                                                                    class="badge {{ $v->type == 'vision' ? 'bg-primary' : 'bg-info text-dark' }}">{{ strtoupper($v->type) }}</span>
                                                            </td>
                                                            <td>{{ $v->content }}</td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm py-0 px-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditVisi{{ $v->id }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                <form action="{{ route('profile.vision.destroy', $v->id) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Hapus data ini?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm py-0 px-1"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <!-- MODAL EDIT VISI MISI -->
                                                        <div class="modal fade" id="modalEditVisi{{ $v->id }}" tabindex="-1"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-0 shadow rounded-4">
                                                                    <div class="modal-header bg-warning text-dark">
                                                                        <h5 class="modal-title fw-bold">Edit Visi / Misi
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('profile.vision.update', $v->id) }}"
                                                                        method="POST">
                                                                        @csrf @method('PUT')
                                                                        <div class="modal-body p-4 text-start">
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label fw-bold">Tipe</label>
                                                                                <select name="type" class="form-select"
                                                                                    required>
                                                                                    <option value="vision" {{ $v->type == 'vision' ? 'selected' : '' }}>Visi</option>
                                                                                    <option value="mission" {{ $v->type == 'mission' ? 'selected' : '' }}>Misi</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Konten
                                                                                    Narasi</label>
                                                                                <textarea name="content"
                                                                                    class="form-control" rows="3"
                                                                                    required>{{ $v->content }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-light border-0">
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm fw-bold">Simpan
                                                                                Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted py-3">Belum ada
                                                                data visi/misi.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- 3. EDITOR PROGRAM UNGGULAN -->
                                    <div class="tab-pane fade" id="editor-program">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fw-bold text-success mb-0">Kelola Program Unggulan</h5>
                                            <button type="button" class="btn btn-success btn-sm fw-bold"
                                                data-bs-toggle="modal" data-bs-target="#modalTambahProgram">
                                                <i class="bi bi-plus-lg"></i> Tambah Program
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle small">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th width="15%">Foto</th>
                                                        <th width="25%">Judul Program</th>
                                                        <th width="45%">Deskripsi</th>
                                                        <th width="15%" class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $programsList = \App\Models\ProfileProgram::all(); @endphp
                                                    @forelse($programsList as $p)
                                                        <tr>
                                                            <td>
                                                                @if(isset($p->image) && $p->image)
                                                                    <img src="{{ asset('storage/' . $p->image) }}"
                                                                        class="rounded shadow-sm"
                                                                        style="width: 45px; height: 35px; object-fit: cover;">
                                                                @else
                                                                    <span class="badge bg-secondary text-light"
                                                                        style="font-size: 9px;">No Photo</span>
                                                                @endif
                                                            </td>
                                                            <td class="fw-bold">{{ $p->title }}</td>
                                                            <td>{{ Str::limit($p->description, 40) }}</td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm py-0 px-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditProgram{{ $p->id }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                <form
                                                                    action="{{ route('profile.program.destroy', $p->id) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Hapus program ini?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm py-0 px-1"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <!-- MODAL EDIT PROGRAM UNGGULAN -->
                                                        <div class="modal fade" id="modalEditProgram{{ $p->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-0 shadow rounded-4">
                                                                    <div class="modal-header bg-warning text-dark">
                                                                        <h5 class="modal-title fw-bold">Edit Program
                                                                            Unggulan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('profile.program.update', $p->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf @method('PUT')
                                                                        <div class="modal-body p-4 text-start">
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Judul
                                                                                    Program</label>
                                                                                <input type="text" name="title"
                                                                                    class="form-control"
                                                                                    value="{{ $p->title }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label fw-bold">Deskripsi</label>
                                                                                <textarea name="description"
                                                                                    class="form-control" rows="3"
                                                                                    required>{{ $p->description }}</textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Ganti Foto
                                                                                    Program (Opsional)</label>
                                                                                <input type="file" name="image"
                                                                                    class="form-control" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-light border-0">
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm fw-bold">Simpan
                                                                                Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-muted py-3">Belum ada
                                                                program.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- 4. EDITOR EVENT TAHUNAN -->
                                    <div class="tab-pane fade" id="editor-event">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fw-bold text-success mb-0">Kelola Kegiatan Event Tahunan</h5>
                                            <button type="button" class="btn btn-success btn-sm fw-bold"
                                                data-bs-toggle="modal" data-bs-target="#modalTambahEvent">
                                                <i class="bi bi-plus-lg"></i> Tambah Event
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle small">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Foto</th>
                                                        <th>Judul Event</th>
                                                        <th>Deskripsi</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $eventsList = \App\Models\ProfileEvent::all(); @endphp
                                                    @forelse($eventsList as $e)
                                                        <tr>
                                                            <td><img src="{{ $e->image ? asset('storage/' . $e->image) : 'https://via.placeholder.com/40' }}"
                                                                    class="rounded shadow-sm"
                                                                    style="width: 45px; height: 35px; object-fit: cover;">
                                                            </td>
                                                            <td class="fw-bold">{{ $e->title }}</td>
                                                            <td>{{ Str::limit($e->description, 40) }}</td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm py-0 px-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditEvent{{ $e->id }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                <form action="{{ route('profile.event.destroy', $e->id) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Hapus event ini?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm py-0 px-1"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <!-- MODAL EDIT EVENT TAHUNAN -->
                                                        <div class="modal fade" id="modalEditEvent{{ $e->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-0 shadow rounded-4">
                                                                    <div class="modal-header bg-warning text-dark">
                                                                        <h5 class="modal-title fw-bold">Edit Kegiatan Event
                                                                            Tahunan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('profile.event.update', $e->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf @method('PUT')
                                                                        <div class="modal-body p-4 text-start">
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Judul
                                                                                    Event</label>
                                                                                <input type="text" name="title"
                                                                                    class="form-control"
                                                                                    value="{{ $e->title }}" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    class="form-label fw-bold">Deskripsi</label>
                                                                                <textarea name="description"
                                                                                    class="form-control" rows="3"
                                                                                    required>{{ $e->description }}</textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label fw-bold">Ganti Foto
                                                                                    Event (Opsional)</label>
                                                                                <input type="file" name="image"
                                                                                    class="form-control" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-light border-0">
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning btn-sm fw-bold">Simpan
                                                                                Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-muted py-3">Belum ada
                                                                event.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================================================================= -->
    <!-- SEMUA MODAL POP-UP -->
    <!-- ================================================================= -->

    <!-- MODAL CREATE GALERI -->
    <div class="modal fade" id="createGalleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-info text-dark">
                    <h5 class="modal-title fw-bold"><i class="bi bi-images me-2"></i> Upload Foto Galeri Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul / Keterangan Foto</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <input type="text" name="category" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">File Foto</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm px-3"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info btn-sm px-3 fw-bold text-dark">Simpan Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE SLIDER -->
    <div class="modal fade" id="createSliderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold"><i class="bi bi-sliders me-2"></i> Tambah Banner Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Banner</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Caption (Opsional)</label>
                            <input type="text" name="caption" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">File Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm px-3"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning btn-sm px-3 fw-bold">Simpan Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE MEDSOS -->
    <div class="modal fade" id="createSocialModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-share me-2"></i> Tambah Media Sosial</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('socials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Platform</label>
                            <select name="platform" class="form-select" required>
                                <option value="YouTube">YouTube</option>
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul / Keterangan</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thumbnail Custom (Opsional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">URL / Link</label>
                            <input type="url" name="url" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_highlight" value="1" class="form-check-input"
                                id="createHighlight">
                            <label class="form-check-label fw-bold" for="createHighlight">Jadikan Highlight
                                Utama</label>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm px-3"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-secondary btn-sm px-3 fw-bold">Simpan Tautan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH GURU -->
    <div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Tambah Data Guru / Pimpinan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.teacher.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIP / NIY</label>
                            <input type="text" name="nip" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jabatan</label>
                            <input type="text" name="position" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Peran (Role)</label>
                            <select name="role" class="form-select" required>
                                <option value="teacher">Guru Biasa</option>
                                <option value="headmaster">Kepala Sekolah</option>
                                <option value="foundation_head">Kepala Yayasan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm fw-bold">Simpan Guru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH VISI MISI -->
    <div class="modal fade" id="modalTambahVisi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Tambah Visi / Misi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.vision.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipe</label>
                            <select name="type" class="form-select" required>
                                <option value="vision">Visi</option>
                                <option value="mission">Misi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Konten Narasi</label>
                            <textarea name="content" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm fw-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PROGRAM (DIPERBAIKI ENCTYPE) -->
    <div class="modal fade" id="modalTambahProgram" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Tambah Program Unggulan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.program.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Program</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Program</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm fw-bold">Simpan Program</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH EVENT -->
    <div class="modal fade" id="modalTambahEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Tambah Kegiatan Event Tahunan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Event</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Event</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm fw-bold">Simpan Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>