<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Riwayat Booking - Dukunify</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 0;
        }
        h2 {
            text-align: center;
            font-size: 1rem;
            font-weight: normal;
            margin-top: 5px;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 0.9rem;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        @media print {
            /* Sembunyikan tombol print di browser saat mencetak */
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <h1>Laporan Riwayat Booking</h1>
    <h2>Platform Dukunify (Dicetak pada: {{ now()->format('d M Y H:i') }})</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Klien</th>
                <th>Dukun (Unit)</th>
                <th>Tgl Sewa</th>
                <th>Tgl Selesai</th>
                <th>Denda (Rp)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($historyBookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->dukun->nama_dukun }}</td>
                    <td>{{ $booking->tanggal_mulai_sewa->format('d/m/Y') }}</td>
                    <td>{{ $booking->tanggal_pengembalian ? $booking->tanggal_pengembalian->format('d/m/Y') : '-' }}</td>
                    <td>{{ number_format($booking->denda, 0, ',', '.') }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        // Otomatis buka dialog print saat halaman dimuat
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>