<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    {{-- Memanggil nomor asli dari tabel invoice --}}
    <title>Invoice {{ $invoice->nomor_invoice }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; color: #000; background: #fff; font-size: 14px; margin: 0; padding: 40px; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px dashed #000; padding-bottom: 15px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 2px; }
        .details-table { w-full; width: 100%; margin-bottom: 20px; }
        .details-table td { padding: 5px; vertical-align: top; }
        .item-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .item-table th, .item-table td { border: 1px solid #000; padding: 10px; text-align: left; }
        .item-table th { background: #f2f2f2; }
        .total-row td { font-weight: bold; border-top: 2px solid #000; }
        .footer { text-align: center; font-size: 12px; margin-top: 50px; border-top: 1px dashed #000; padding-top: 20px; }
        
        /* Hide buttons when printing */
        @media print { .no-print { display: none; } .invoice-box { box-shadow: none; border: none; padding: 0; } body { padding: 0; } }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <div class="header">
            <h1>SISTEM TANI INVOICE</h1>
            <p>Bukti Transaksi Penjualan Hasil Bumi</p>
        </div>

        <table class="details-table">
            <tr>
                <td style="width: 50%;">
                    {{-- Menampilkan Nomor Invoice dan Tanggal Cetak dari tabel invoice --}}
                    <strong>Nomor Invoice:</strong> {{ $invoice->nomor_invoice }}<br>
                    <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::parse($invoice->tanggal_cetak)->translatedFormat('d F Y') }}<br>
                    <strong>Kasir/Petani:</strong> {{ Auth::user()->name ?? 'Admin' }}
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong>Kepada (Pembeli):</strong><br>
                    <span style="font-size: 18px; text-transform: uppercase;">{{ $transaksi->nama_pembeli }}</span>
                </td>
            </tr>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Komoditas</th>
                    <th>Kualitas</th>
                    <th style="text-align: center;">Kuantitas (Kg)</th>
                    <th style="text-align: right;">Harga per Kg</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaksi->hasilPanen->komoditas }}<br><small>Lahan: {{ $transaksi->hasilPanen->batchTanam->lahan->nama_lahan ?? '-' }}</small></td>
                    <td>{{ $transaksi->hasilPanen->kualitas }}</td>
                    <td style="text-align: center;">{{ $transaksi->jumlah_kg }}</td>
                    <td style="text-align: right;">Rp {{ number_format($transaksi->harga_per_kg, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4" style="text-align: right; text-transform: uppercase;">Total Pembayaran:</td>
                    <td style="text-align: right; font-size: 18px;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Terima kasih atas kerjasamanya.<br>Invoice ini sah dan digenerate otomatis oleh aplikasi Sistem Tani.</p>
        </div>
    </div>
</body>
</html>