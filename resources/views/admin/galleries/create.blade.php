<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri - Admin MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 800px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Tambah Foto Galeri Baru</h4>

            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- sisa kode input ke bawah biarkan sama -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Foto</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                        placeholder="Contoh: Kegiatan Upacara Bendera" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category') }}"
                        placeholder="Contoh: Kegiatan / Fasilitas / Prestasi" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">File Foto</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, WEBP (Maksimal 2MB)</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard', ['tab' => 'galleries']) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>