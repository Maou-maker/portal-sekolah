<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Berita - Admin MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Quill Rich Text CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            background-color: #f8f9fa;
        }

        .ql-container.ql-snow {
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            background-color: #ffffff;
            min-height: 250px;
            font-size: 1rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container my-5" style="max-width: 800px;">
        <div class="card border-0 shadow-sm p-4 rounded-4">
            <h4 class="fw-bold mb-4 text-success"><i class="bi bi-file-earmark-plus me-2"></i> Tambah Berita Baru</h4>

            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="createNewsForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Berita</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                        placeholder="Masukkan judul berita" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Berita</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, WEBP (Maksimal 2MB)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Isi / Konten Berita</label>
                    <!-- Kontainer Quill Editor -->
                    <div id="editor-create">{!! old('content') !!}</div>
                    <!-- Hidden input buat nyimpen data HTML ke database -->
                    <input type="hidden" name="content" id="content-create">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.dashboard', ['tab' => 'news']) }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold px-4">Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quill JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const quill = new Quill('#editor-create', {
                theme: 'snow',
                placeholder: 'Tuliskan isi berita di sini...',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ color: [] }, { background: [] }],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link', 'blockquote'],
                        ['clean']
                    ]
                }
            });

            const form = document.querySelector('#createNewsForm');
            if (form) {
                form.onsubmit = function () {
                    document.querySelector('#content-create').value = quill.root.innerHTML;
                };
            }
        });
    </script>
</body>

</html>