<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Slider - Admin MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 800px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4">Edit Banner Slider</h4>

            <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Banner</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Caption / Sub-Judul (Opsional)</label>
                    <input type="text" name="caption" class="form-control"
                        value="{{ old('caption', $slider->caption) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ganti Gambar Banner (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard', ['tab' => 'sliders']) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold">Update Slider</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>