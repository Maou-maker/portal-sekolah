<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Media Sosial - Admin MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ route('admin.dashboard') }}">PANEL ADMIN</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm"><i
                    class="bi bi-arrow-left"></i> Dashboard</a>
        </div>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Kelola Tautan Media Sosial & Highlight</h3>
            <a href="{{ route('socials.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Link
                Medsos</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card border-0 shadow-sm">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Platform</th>
                        <th>Judul Konten / Post</th>
                        <th>Status Highlight</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($socials as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $item->platform == 'YouTube' ? 'danger' : ($item->platform == 'TikTok' ? 'dark' : 'primary') }}">
                                    {{ $item->platform }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $item->title }}</div>
                                <a href="{{ $item->url }}" target="_blank"
                                    class="small text-muted text-decoration-none text-truncate d-inline-block"
                                    style="max-width: 300px;">{{ $item->url }}</a>
                            </td>
                            <td>
                                @if($item->is_highlight)
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Ditampilkan di
                                        Beranda</span>
                                @else
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('socials.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('socials.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus tautan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada link media sosial.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>