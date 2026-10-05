<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MA Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm border-0 p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center fw-bold text-success mb-1">MA HASANUDDIN</h3>
        <p class="text-center text-muted small mb-4">Panel Login Administrator Website</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label font-weight-bold">Email Admin</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                    placeholder="admin@mahasanuddin.sch.id" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-success w-100 fw-bold py-2 mt-2">Masuk ke Dashboard</button>
        </form>
    </div>

</body>

</html>