<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kendaraan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Pendapatan Parkiran</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal Laporan</th>
                <th>Jumlah Kendaraan</th>
                <th>Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
            <tr>
                <td>{{ optional($item->tgl_laporan)->format('d-m-Y') }}</td>
                <td>{{ $item->jumlah_kendaraan }}</td>
                <td>Rp. {{ number_format($item->pendapatan_rp, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
