<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Riwayat Booking - Dukunify</title>
    {{-- Menggunakan font Inter atau fallback ke sans-serif --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif; /* Prioritaskan Inter, fallback ke sans-serif */
            margin: 20px;
            color: #1f2937; /* Teks gelap default (gray-800) */
            line-height: 1.4; /* Sedikit rapatkan spasi baris */
            font-size: 10pt;
        }
        .container {
            width: 100%;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 1px solid #d1d5db; /* Border abu-abu (gray-300) */
            padding-bottom: 15px;
        }
        h1 {
            font-size: 16pt;
            font-weight: 600;
            color: #4f46e5; /* Warna Indigo gelap (indigo-600) */
            margin-bottom: 5px;
        }
        h2 {
            font-size: 11pt;
            font-weight: 400;
            color: #6b7280; /* Abu-abu (gray-500) */
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            page-break-inside: auto; 
        }
         tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        thead {
            display: table-header-group; /* Ulangi header di tiap halaman PDF */
        }
         tbody {
            display: table-row-group;
        }
        th, td {
            border: 1px solid #e5e7eb; /* Border abu-abu terang (gray-200) */
            padding: 8px 10px;
            font-size: 9pt;
            vertical-align: middle; 
            text-align: left;
        }
        th {
            background-color: #f9fafb; /* Latar header sangat terang (gray-50) */
            font-weight: 600;
            color: #374151; /* Warna teks header (gray-700) */
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        /* Zebra striping tipis */
        tbody tr:nth-child(even) { 
            background-color: #f9fafb; /* gray-50 */
        } 
        /* Warna Status (Gunakan warna teks standar) */
        td.status-selesai { color: #15803d; font-weight: 600; } /* green-700 */
        td.status-pending { color: #a16207; font-weight: 600; } /* yellow-700 */
        td.status-menunggu { color: #b91c1c; font-weight: 600; } /* red-700 */
        td.status-aktif { color: #0369a1; font-weight: 600; } /* sky-700 */
        td.align-right { text-align: right; }
        .no-data {
            text-align: center;
            color: #6b7280; /* gray-500 */
            padding: 20px;
            font-style: italic;
        }
        .currency {
           font-weight: 600;
        }
        .denda-merah {
            color: #dc2626; /* red-600 */
            font-weight: 600;
        }

        /* Aturan print (minimalis, karena DomPDF sudah dalam konteks print) */
        @media print {
            body { 
                margin: 1cm;
                font-size: 9pt; /* Ukuran font print bisa sedikit lebih kecil */
            }
             th, td { font-size: 8pt; padding: 5px 7px; }
             a { text-decoration: none; color: inherit; } /* Hapus style link */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Laporan Riwayat Booking</h1>
            <h2>Platform Dukunify (Dicetak pada: {{ now()->format('d M Y H:i') }})</h2>
        </div>

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
                        <td class="align-right {{ $booking->denda > 0 ? 'denda-merah' : 'currency' }}">
                            {{ number_format($booking->denda, 0, ',', '.') }}
                        </td>
                        <td
                            @class([
                                'status-selesai' => $booking->status == 'selesai',
                                'status-pending' => $booking->status == 'pending_completion',
                                'status-menunggu' => $booking->status == 'menunggu_pembayaran_denda' || $booking->status == 'menunggu_konfirmasi_pembayaran',
                                'status-aktif' => $booking->status == 'aktif',
                            ])>
                            {{ Str::headline($booking->status) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="no-data">Tidak ada data riwayat yang cocok dengan filter.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>