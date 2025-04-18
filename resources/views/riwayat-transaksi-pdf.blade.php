<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0052cc;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --black: #212529;
            --white: #ffffff;
            --light-gray: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            background-color: var(--white);
            color: var(--black);
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: var(--white);
            padding: 20px;
            margin: 0 auto;
            max-width: 1000px;
            border: 1px solid var(--border-color);
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .table-container {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--border-color);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid var(--border-color);
        }

        th {
            background-color: var(--primary-color);
            color: var(--white);
            font-weight: 600;
        }

        tr:nth-child(odd) {
            background-color: var(--white);
        }

        tr:nth-child(even) {
            background-color: var(--light-gray);
        }

        .credit-value {
            color: var(--danger-color);
            font-weight: 500;
        }

        .debit-value {
            color: var(--success-color);
            font-weight: 500;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background-color: var(--success-color);
            color: var(--white);
        }

        .badge-warning {
            background-color: var(--warning-color);
            color: var(--black);
        }

        .badge-danger {
            background-color: var(--danger-color);
            color: var(--white);
        }

        .badge-secondary {
            background-color: #6c757d;
            color: var(--white);
        }

        @media print {
            body {
                padding: 0;
            }
            .container {
                border: none;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Riwayat Transaksi</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mutasi as $item)
                        <tr>
                            <td>{{ $item->user->name ?? 'Unknown' }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="debit-value">
                                {{ $item->debit > 0 ? 'Rp ' . number_format($item->debit, 0, ',', '.') : '-' }}
                            </td>
                            <td class="credit-value">
                                {{ $item->credit > 0 ? 'Rp ' . number_format($item->credit, 0, ',', '.') : '-' }}
                            </td>
                            <td>
                                @if($item->status === 'done')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($item->status === 'process')
                                    <span class="badge badge-warning">Diproses</span>
                                @elseif($item->status === 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-secondary">Tidak diketahui</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>