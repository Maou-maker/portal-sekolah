<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Slider - Admin MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 800px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Tambah Banner Slider Baru</h4>

            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Banner</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                        placeholder="Contoh: Selamat Datang di MA Hasanuddin" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Caption / Sub-Judul (Opsional)</label>
                    <input type="text" name="caption" class="form-control" value="{{ old('caption') }}"
                        placeholder="Contoh: Mewujudkan Generasi Unggul dan Berakhlaqul Karimah">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">File Gambar Banner (Rekomendasi Landscape)</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, WEBP (Maksimal 2MB)</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard', ['tab' => 'sliders']) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold">Simpan Slider</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>