<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Konten Profil - Admin MA Hasanuddin</title>
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
            <h3 class="fw-bold">Kelola Konten & Posisi Zig-Zag Landing Page</h3>
            <a href="{{ route('sections.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Konten
                Baru</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card border-0 shadow-sm">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Badge & Judul</th>
                        <th>Posisi Gambar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $item->image }}" class="rounded"
                                    style="width: 80px; height: 50px; object-fit: cover;"></td>
                            <td>
                                <span class="badge bg-secondary mb-1">{{ $item->badge }}</span>
                                <div class="fw-bold">{{ $item->title }}</div>
                            </td>
                            <td><span class="badge bg-info text-dark">Gambar di {{ ucfirst($item->position) }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('sections.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('sections.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus konten ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada konten profil.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>