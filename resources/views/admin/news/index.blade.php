<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Berita - Admin MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ route('admin.dashboard') }}">PANEL ADMIN MA
                HASANUDDIN</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm"><i
                    class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Kelola Berita & Informasi</h3>
            <a href="{{ route('news.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Berita
                Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 100px;">Gambar</th>
                            <th>Judul Berita</th>
                            <th style="width: 180px;">Tgl Publish</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ $item->image }}" class="rounded"
                                            style="width: 70px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $item->title }}</td>
                                <td class="small text-muted">
                                    {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada berita yang diterbitkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>