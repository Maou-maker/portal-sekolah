<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Section - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 700px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Tambah Konten & Layout Section Baru</h4>

            <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Section</label>
                    <input type="text" name="title" class="form-control" required placeholder="Contoh: Profil Unggulan">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Isi Konten / Narasi</label>
                    <textarea name="content" class="form-control" rows="4" required
                        placeholder="Tulis narasi di sini..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Posisi Layout Gambar & Teks</label>
                    <select name="position" class="form-select" required>
                        <option value="left">Gambar di Kiri, Teks di Kanan</option>
                        <option value="right">Gambar di Kanan, Teks di Kiri</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Upload Gambar Pendukung (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="activeCheck" value="1" checked>
                    <label class="form-check-label fw-semibold" for="activeCheck">Tampilkan di Beranda Utama</label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard', ['tab' => 'sections']) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold">Simpan Section</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>