<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6; /* Soft Blue */
            --primary-dark: #2563eb; /* Blue-600 */
            --primary-light: #eff6ff; /* Blue-50 */
            --dark: #1f2937; /* Slate-800 */
            --light-gray: #f9fafb; /* Very Light Gray */
            --white: #ffffff;
            --success: #14b8a6; /* Teal-500 */
            --warning: #f97316; /* Orange-500 */
            --danger: #ef4444; /* Red-500 */
            --sidebar-width: 220px;
        }

        body {
            background-color: var(--light-gray);
            color: var(--dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            min-height: 100vh;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: var(--primary);
            width: var(--sidebar-width);
            padding: 20px;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        .logo-area {
            margin-bottom: 30px;
            text-align: center;
        }

        .logo-text {
            color: var(--white);
            font-size: 20px;
            font-weight: 600;
        }

        .user-info {
            background-color: var(--primary-dark);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            color: var(--white);
        }

        .user-role {
            font-size: 12px;
            text-transform: uppercase;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            color: var(--white);
            padding: 8px 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link.active {
            background-color: var(--primary-dark);
        }

        .nav-link i {
            width: 20px;
            margin-right: 8px;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            width: calc(100% - 40px);
            background-color: var(--danger);
            border: none;
            color: var(--white);
            border-radius: 6px;
        }

        .page-title {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .card {
            background-color: var(--white);
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid var(--primary-light);
        }

        .card-header {
            background-color: var(--primary-light);
            padding: 10px 15px;
            border-bottom: 1px solid var(--primary-light);
        }

        .card-title {
            color: var(--primary);
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }

        .card-body {
            padding: 15px;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
        }

        .btn-danger {
            background-color: var(--danger);
            border: none;
            border-radius: 6px;
        }

        .btn-warning {
            background-color: var(--warning);
            border: none;
            color: var(--dark);
            border-radius: 6px;
        }

        .btn-icon i {
            margin-right: 6px;
        }

        .table {
            color: var(--dark);
        }

        .table thead th {
            background-color: var(--primary);
            color: var(--white);
            padding: 10px;
            font-weight: 500;
        }

        .table tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--primary-light);
        }

        .form-control {
            border: 1px solid var(--primary-light);
            border-radius: 6px;
            padding: 8px 12px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .input-group-text {
            background-color: var(--primary);
            color: var(--white);
            border: 1px solid var(--primary);
        }

        .form-label {
            color: var(--dark);
            font-weight: 500;
            margin-bottom: 6px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .modal-content, .offcanvas {
            background-color: var(--white);
            border-radius: 8px;
        }

        .modal-header, .offcanvas-header {
            border-bottom: 1px solid var(--primary-light);
            padding: 10px 15px;
        }

        .modal-footer, .offcanvas-body {
            border-top: 1px solid var(--primary-light);
            padding: 15px;
        }

        .balance-card {
            background-color: var(--primary);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            color: var(--white);
        }

        .balance-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .balance-amount {
            font-size: 28px;
            font-weight: 600;
        }

        .stats-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 15px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid var(--primary-light);
        }

        .stats-icon {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .stats-icon i {
            font-size: 18px;
            color: var(--white);
        }

        .stats-title {
            font-size: 14px;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .stats-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        .transaction-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--white);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid var(--primary-light);
        }

        .transaction-info {
            display: flex;
            align-items: center;
        }

        .transaction-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .transaction-details h5 {
            font-size: 14px;
            margin-bottom: 4px;
            color: var(--dark);
        }

        .transaction-details span {
            font-size: 12px;
            color: var(--dark);
            opacity: 0.7;
        }

        .transaction-amount.credit {
            color: var(--success);
            font-weight: 600;
        }

        .transaction-amount.debit {
            color: var(--danger);
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .user-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--primary-light);
        }

        .user-card-info {
            display: flex;
            align-items: center;
        }

        .user-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: var(--white);
        }

        .user-actions {
            display: flex;
            gap: 6px;
        }

        .request-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid var(--primary-light);
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .request-amount {
            background-color: var(--primary);
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 500;
            color: var(--white);
        }

        .request-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .badge-role {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 10px;
            text-transform: capitalize;
        }

        .role-siswa {
            background-color: var(--success);
            color: var(--white);
        }

        .role-bank {
            background-color: var(--primary);
            color: var(--white);
        }

        .role-admin {
            background-color: var(--danger);
            color: var(--white);
        }

        .offcanvas {
            max-width: 350px;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="sidebar">
            <div class="logo-area">
                <div class="logo-text">BKKBN BANK</div>
            </div>

            <div class="user-info">
                <i class="fas fa-user-circle fa-2x mb-2"></i>
                <div>{{ Auth::user()->name }}</div>
                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->role === 'bank')
                    <li class="nav-item">
                        <button class="btn btn-primary w-100 text-start" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fas fa-user-plus"></i> Tambah Pengguna
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary w-100 text-start" data-bs-toggle="modal" data-bs-target="#saldoModal">
                            <i class="fas fa-wallet"></i> Saldo Siswa
                        </button>
                    </li>
                @endif
                @if (Auth::user()->role === 'siswa')
                    <li class="nav-item mt-2">
                        <a href="{{ route('export.pdf.student') }}" class="btn btn-success w-100 text-start">
                            <i class="fas fa-file-pdf"></i> Unduh Riwayat
                        </a>
                    </li>
                @endif
            </ul>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <div class="content-wrapper">
            @if (Auth::user()->role == 'admin')
                <h2 class="page-title">Dashboard Admin</h2>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stats-info">
                                <div class="stats-title">Total Pengguna</div>
                                <div class="stats-value">{{ $users->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="stats-info">
                                <div class="stats-title">Siswa</div>
                                <div class="stats-value">{{ $users->where('role', 'siswa')->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <div class="stats-info">
                                <div class="stats-title">Transaksi</div>
                                <div class="stats-value">{{ $mutasi->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Transaksi Terbaru</h5>
                            </div>
                            <div class="card-body">
                                @if ($mutasi->isEmpty())
                                    <p>Tidak ada transaksi ditemukan.</p>
                                @else
                                    @foreach ($mutasi->take(5) as $mutation)
                                        <div class="transaction-card">
                                            <div class="transaction-info">
                                                <div class="transaction-icon {{ $mutation->credit > 0 ? 'credit' : 'debit' }}">
                                                    <i class="fas {{ $mutation->credit > 0 ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                                </div>
                                                <div class="transaction-details">
                                                    <h5>{{ $mutation->description }}</h5>
                                                    <span>{{ $mutation->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                            </div>
                                            <div class="transaction-amount {{ $mutation->credit > 0 ? 'credit' : 'debit' }}">
                                                {{ $mutation->credit > 0 ? '+' : '-' }} Rp
                                                {{ number_format($mutation->credit > 0 ? $mutation->credit : $mutation->debit, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Manajemen Pengguna</h5>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="fas fa-plus"></i> Tambah Pengguna
                                </button>
                            </div>
                            <div class="card-body">
                                @if ($users->isEmpty())
                                    <p>Tidak ada pengguna ditemukan.</p>
                                @else
                                    @foreach ($users->take(10) as $user)
                                        <div class="user-card">
                                            <div class="user-card-info">
                                                <div class="user-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                                    <div class="d-flex align-items-center">
                                                        <small class="me-2">{{ $user->email }}</small>
                                                        <span class="badge badge-role {{ 'role-' . $user->role }}">{{ ucfirst($user->role) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-actions">
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('delete-user', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user()->role == 'siswa')
                <h2 class="page-title">Dashboard Siswa</h2>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="balance-card">
                            <h4 class="balance-title">Saldo Kamu</h4>
                            <div class="balance-amount">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="stats-card">
                                    <div class="stats-icon">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                    <div class="stats-info">
                                        <div class="stats-title">Total Pengeluaran</div>
                                        <div class="stats-value">Rp {{ number_format($mutasi->sum('debit'), 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stats-card">
                                    <div class="stats-icon">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <div class="stats-info">
                                        <div class="stats-title">Total Pemasukan</div>
                                        <div class="stats-value">Rp {{ number_format($mutasi->sum('credit'), 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Operasi Saldo</h5>
                            </div>
                            <div class="card-body">
                                <div class="action-buttons">
                                    <button class="btn btn-primary btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#topUpOffcanvas" aria-controls="topUpOffcanvas">
                                        <i class="fas fa-plus-circle"></i> Isi Saldo
                                    </button>
                                    <button class="btn btn-danger btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#withdrawOffcanvas" aria-controls="withdrawOffcanvas">
                                        <i class="fas fa-minus-circle"></i> Tarik Saldo
                                    </button>
                                    <button class="btn btn-warning btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#transferOffcanvas" aria-controls="transferOffcanvas">
                                        <i class="fas fa-exchange-alt"></i> Transfer Saldo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Riwayat Transaksi</h5>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                        <li><a class="dropdown-item {{ request('filter') == 'all' || !request('filter') ? 'active' : '' }}" href="{{ route('home', ['filter' => 'all']) }}">Semua Transaksi</a></li>
                                        <li><a class="dropdown-item {{ request('filter') == 'topup' ? 'active' : '' }}" href="{{ route('home', ['filter' => 'topup']) }}">Top-up</a></li>
                                        <li><a class="dropdown-item {{ request('filter') == 'withdraw' ? 'active' : '' }}" href="{{ route('home', ['filter' => 'withdraw']) }}">Tarik</a></li>
                                        <li><a class="dropdown-item {{ request('filter') == 'transfer' ? 'active' : '' }}" href="{{ route('home', ['filter' => 'transfer']) }}">Transfer</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($mutasi->isEmpty())
                                    <p>Belum ada transaksi.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Debit</th>
                                                    <th>Kredit</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mutasi as $item)
                                                    <tr>
                                                        <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->debit > 0 ? 'Rp ' . number_format($item->debit, 0, ',', '.') : '-' }}</td>
                                                        <td>{{ $item->credit > 0 ? 'Rp ' . number_format($item->credit, 0, ',', '.') : '-' }}</td>
                                                        <td>
                                                            @if ($item->status === 'done')
                                                                <span class="badge bg-success">Selesai</span>
                                                            @elseif($item->status === 'process')
                                                                <span class="badge bg-warning text-dark">Diproses</span>
                                                            @elseif($item->status === 'rejected')
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            @else
                                                                <span class="badge bg-secondary">Tidak diketahui</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user()->role == 'bank')
                <h2 class="page-title">Dashboard Bank</h2>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Top-Up ke Siswa</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('bank.topup') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                        <select name="siswa_id" class="form-control" required>
                                            @foreach ($users->where('role', 'siswa') as $siswa)
                                                <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="form-label">Nominal</label>
                                        <input type="number" name="amount" class="form-control" required min="10000">
                                    </div>
                                    <button type="submit" class="btn btn-success">Top-up Siswa</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Withdraw Siswa</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('bank.withdraw') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                        <select name="siswa_id" class="form-control" required>
                                            @foreach ($users->where('role', 'siswa') as $siswa)
                                                <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="form-label">Nominal</label>
                                        <input type="number" name="amount" class="form-control" required min="10000">
                                    </div>
                                    <button type="submit" class="btn btn-danger">Withdraw dari Siswa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-money-check-alt"></i>
                            </div>
                            <div class="stats-info">
                                <div class="stats-title">Permintaan Tertunda</div>
                                <div class="stats-value">{{ isset($request_payment) ? count($request_payment) : 0 }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stats-info">
                                <div class="stats-title">Siswa Aktif</div>
                                <div class="stats-value">{{ $users->where('role', 'siswa')->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <div class="stats-info">
                                <div class="stats-title">Total Transaksi</div>
                                <div class="stats-value">{{ $mutasi->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Permintaan Pembayaran</h5>
                            </div>
                            <div class="card-body">
                                @if (empty($request_payment) || count($request_payment) == 0)
                                    <div class="text-center py-4">
                                        <i class="fas fa-inbox fa-2x mb-2" style="opacity: 0.6;"></i>
                                        <p>Tidak ada permintaan pembayaran tertunda.</p>
                                    </div>
                                @else
                                    @foreach ($request_payment as $wallet)
                                        <div class="request-card">
                                            <div class="request-header">
                                                <h5>{{ $wallet->description }}</h5>
                                                <span class="request-amount">Rp {{ number_format($wallet->credit - $wallet->debit, 0, ',', '.') }}</span>
                                            </div>
                                            <div>
                                                <span class="text-muted">{{ $wallet->created_at->format('d M Y, H:i') }}</span>
                                                <span class="badge bg-warning ms-2">Tertunda</span>
                                            </div>
                                            <div class="request-actions">
                                                <form action="{{ route('approve', $wallet->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-check"></i> Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('reject', $wallet->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Riwayat Semua Transaksi</h5>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                        <li>
                                            <form method="GET" style="margin: 0;">
                                                <input type="hidden" name="filter" value="all">
                                                <button type="submit" class="dropdown-item">Semua Transaksi</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="GET" style="margin: 0;">
                                                <input type="hidden" name="filter" value="topup">
                                                <button type="submit" class="dropdown-item">Top-up</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="GET" style="margin: 0;">
                                                <input type="hidden" name="filter" value="withdraw">
                                                <button type="submit" class="dropdown-item">Tarik</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="GET" style="margin: 0;">
                                                <input type="hidden" name="filter" value="transfer">
                                                <button type="submit" class="dropdown-item">Transfer</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($mutasi->isEmpty())
                                    <p>Tidak ada transaksi ditemukan.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Pengguna</th>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Debit</th>
                                                    <th>Kredit</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($mutasi->take(5) as $item)
                                                    <tr>
                                                        <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                                                        <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->debit > 0 ? 'Rp ' . number_format($item->debit, 0, ',', '.') : '-' }}</td>
                                                        <td>{{ $item->credit > 0 ? 'Rp ' . number_format($item->credit, 0, ',', '.') : '-' }}</td>
                                                        <td>
                                                            @if ($item->status == 'done')
                                                                <span class="badge bg-success">Selesai</span>
                                                            @elseif ($item->status == 'process')
                                                                <span class="badge bg-warning text-dark">Diproses</span>
                                                            @elseif ($item->status == 'rejected')
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            @else
                                                                <span class="badge bg-secondary">Lainnya</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('mutasi.index') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-eye"></i> Lihat Semua
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal untuk Tambah Pengguna -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('add-user') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="role" class="form-label">Peran</label>
                            <select name="role" class="form-control" required>
                                @if (Auth::user()->role === 'bank')
                                    <option value="siswa">Siswa</option>
                                @else
                                    <option value="siswa">Siswa</option>
                                    <option value="admin">Admin</option>
                                    <option value="bank">Bank</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk Saldo Siswa -->
    <div class="modal fade" id="saldoModal" tabindex="-1" aria-labelledby="saldoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saldoModalLabel">Saldo Semua Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users->where('role', 'siswa') as $siswa)
                                <tr>
                                    <td>{{ $siswa->name }}</td>
                                    <td>Rp {{ number_format($siswa->saldo, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Pengguna -->
    @foreach ($users as $user)
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('update-user', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Kata Sandi Baru (opsional)</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Perbarui Pengguna</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Offcanvas untuk Isi Saldo -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="topUpOffcanvas" aria-labelledby="topUpOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="topUpOffcanvasLabel">Isi Saldo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('topUp') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="credit" class="form-label">Jumlah</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" name="credit" id="credit" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-plus-circle"></i> Top-up
                </button>
            </form>
        </div>
    </div>

    <!-- Offcanvas untuk Tarik Saldo -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="withdrawOffcanvas" aria-labelledby="withdrawOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="withdrawOffcanvasLabel">Tarik Saldo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('withdraw') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="credit" class="form-label">Jumlah</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" name="credit" id="credit" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-minus-circle"></i> Tarik
                </button>
            </form>
        </div>
    </div>

    <!-- Offcanvas untuk Transfer Saldo -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="transferOffcanvas" aria-labelledby="transferOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="transferOffcanvasLabel">Transfer Saldo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('transfer') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="recepient_id" class="form-label">Penerima</label>
                    <select name="recepient_id" class="form-control" required>
                        @foreach ($users as $user)
                            @if ($user->role == 'siswa')
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount" class="form-label">Jumlah</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning w-100">
                    <i class="fas fa-exchange-alt"></i> Transfer
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>