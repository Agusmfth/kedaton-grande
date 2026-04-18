<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Kedaton Grande</title>
    <style>
        body {
            color: #111827;
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 24px;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        .header {
            border-bottom: 2px solid #111827;
            margin-bottom: 18px;
            padding-bottom: 12px;
            text-align: center;
        }

        .meta,
        .summary {
            margin-bottom: 16px;
        }

        .summary table,
        .data-table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 7px;
            vertical-align: top;
        }

        th {
            background: #f1f5f9;
            text-align: center;
        }

        .section-title {
            margin: 20px 0 8px;
        }

        .text-center {
            text-align: center;
        }

        .print-actions {
            margin-bottom: 16px;
            text-align: right;
        }

        .print-actions button {
            background: #2563eb;
            border: 0;
            color: #fff;
            cursor: pointer;
            padding: 8px 14px;
        }

        @media print {
            .print-actions {
                display: none;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="print-actions">
        <button onclick="window.print()">Cetak</button>
    </div>

    <div class="header">
        <h2>Laporan Kedaton Grande</h2>
        <p>Sistem Layanan Serah Terima Kunci dan Pengaduan Konsumen</p>
    </div>

    <div class="meta">
        <p>
            Periode:
            <strong>{{ $tanggalAwal ?: 'Awal data' }}</strong>
            sampai
            <strong>{{ $tanggalAkhir ?: 'Akhir data' }}</strong>
        </p>
        <p>Dicetak oleh: <strong>{{ auth()->user()->name }}</strong></p>
        <p>Tanggal cetak: <strong>{{ now()->format('d-m-Y H:i') }}</strong></p>
    </div>

    <div class="summary">
        <table>
            <tr>
                <th>Total Serah Terima</th>
                <th>Total Pengaduan</th>
                <th>Belum Selesai</th>
                <th>Selesai</th>
            </tr>
            <tr class="text-center">
                <td>{{ $totalSerahTerima }}</td>
                <td>{{ $totalPengaduan }}</td>
                <td>{{ $totalBelumSelesai }}</td>
                <td>{{ $totalSelesai }}</td>
            </tr>
        </table>
    </div>

    <h3 class="section-title">Data Serah Terima Kunci</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Konsumen</th>
                <th>Username</th>
                <th>Blok</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($serahTerima as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->user->username ?? '-' }}</td>
                <td class="text-center">{{ $item->blok }}</td>
                <td class="text-center">{{ $item->tanggal_serah_terima }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data serah terima kunci.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="section-title">Data Pengaduan Konsumen</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Konsumen</th>
                <th>Judul</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduan as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->keluhan }}</td>
                <td class="text-center">
                    @if($item->status == 'baru')
                        Baru
                    @elseif($item->status == 'diproses')
                        Diproses Admin
                    @elseif($item->status == 'diteruskan_lapangan')
                        Diteruskan ke Lapangan
                    @elseif($item->status == 'dikerjakan')
                        Dikerjakan
                    @elseif($item->status == 'selesai')
                        Selesai
                    @endif
                </td>
                <td class="text-center">{{ $item->tanggal_pengaduan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data pengaduan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
