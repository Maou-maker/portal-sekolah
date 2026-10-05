<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Media Sosial - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 700px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Edit Tautan Media Sosial</h4>

            <!-- HANYA ADA 1 TAG FORM UTAMA DENGAN ENCTYPE -->
            <form action="{{ route('admin.socials.update', $social->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Platform</label>
                    <select name="platform" class="form-select" required>
                        <option value="Instagram" {{ $social->platform == 'Instagram' ? 'selected' : '' }}>Instagram
                        </option>
                        <option value="TikTok" {{ $social->platform == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                        <option value="YouTube" {{ $social->platform == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Postingan / Video</label>
                    <input type="text" name="title" class="form-control" required
                        value="{{ old('title', $social->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">URL Tautan</label>
                    <input type="url" name="url" class="form-control" required value="{{ old('url', $social->url) }}">
                </div>

                <!-- Tambahan Input Upload Thumbnail / Foto Media Sosial -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Foto / Thumbnail (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_highlight" class="form-check-input" id="highlightCheck" value="1" {{ $social->is_highlight ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="highlightCheck">Tampilkan sebagai Highlight di
                        Beranda Utama</label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard', ['tab' => 'socials']) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold">Update Tautan</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>