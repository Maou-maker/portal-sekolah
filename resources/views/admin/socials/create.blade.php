<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Media Sosial - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 700px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Tambah Tautan Media Sosial</h4>

            {{-- PERBAIKAN DI SINI: Tambahkan prefix 'admin.' pada route-nya --}}
            <form action="{{ route('admin.socials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Platform</label>
                    <select name="platform" class="form-select" required>
                        <option value="Instagram">Instagram</option>
                        <option value="TikTok">TikTok</option>
                        <option value="YouTube">YouTube</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Postingan / Video</label>
                    <input type="text" name="title" class="form-control" required
                        placeholder="Contoh: Keseruan Kegiatan Pesantren Kilat" value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">URL Tautan</label>
                    <input type="url" name="url" class="form-control" required placeholder="https://..."
                        value="{{ old('url') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Thumbnail Custom (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_highlight" class="form-check-input" id="highlightCheck" value="1">
                    <label class="form-check-label fw-semibold" for="highlightCheck">Tampilkan sebagai Highlight di
                        Beranda Utama</label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard', ['tab' => 'socials']) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold">Simpan Tautan</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>