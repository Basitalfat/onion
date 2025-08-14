<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Export Laporan Ikhbar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 4px;
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .no-border {
            border: none;
        }

        .signature {
            width: 100%;
            margin-top: 50px;
        }

        .signature td {
            text-align: center;
            border: none;
        }

        .logo {
            float: left;
            width: 80px;
        }

        .header {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <p><strong>Imarotul Muslimin</strong><br>TADBIR SYU'BAH</p>
        <p><strong>IKHBAR SYAHRIYAH QISMU BINA</strong><br>No. Syu.../U/.../Xx....</p>
        <p>Syahr : RAMADHAN 1446 H</p>
    </div>

    {{-- Tabel 1: Rekap Halaqoh Reguler --}}
    <table>
        <thead>
            <tr>
                <th colspan="8">Rekapitulasi Absensi Halaqoh Reguler</th>
            </tr>
            <tr>
                <th>Kode Halaqoh</th>
                <th>Jml. Ahlu Halaqoh</th>
                <th>Jml. Liqo</th>
                <th>Jml. Wajib Hadir</th>
                <th colspan="3">Absen</th>
                <th>% Absen</th>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th>I</th>
                <th>TI</th>
                <th>JML</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($halaqohReguler as $item)
                <tr>
                    <td>{{ $item['kode'] }}</td>
                    <td>{{ $item['jumlah_ahlu'] }}</td>
                    <td>{{ $item['jumlah_liqo'] }}</td>
                    <td>{{ $item['jumlah_wajib'] }}</td>
                    <td>{{ $item['izin'] }}</td>
                    <td>{{ $item['tanpa_izin'] }}</td>
                    <td>{{ $item['absen_total'] }}</td>
                    <td>{{ $item['persentase'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Tabel 2: Rekap Mudzakkir --}}
    <table>
        <thead>
            <tr>
                <th colspan="5">Rekap Absensi Mudzakkir</th>
            </tr>
            <tr>
                <th>Mudz. Syu’bah</th>
                <th>Mudz. Jam’iah</th>
                <th>Total</th>
                <th>Kode Mudzakkir Jam’iah Absen / Frekuensi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $mudzakkir['syubah'] }}</td>
                <td>{{ $mudzakkir['jamiah'] }}</td>
                <td>{{ $mudzakkir['total'] }}</td>
                <td colspan="2">{{ $mudzakkir['frekuensi'] }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-left">Terjadwal: {{ $mudzakkir['terjadwal'] }} | Hadir:
                    {{ $mudzakkir['hadir'] }} | Absen: {{ $mudzakkir['absen'] }} | Persentase:
                    {{ $mudzakkir['persentase'] }}%</td>
            </tr>
        </tbody>
    </table>

    {{-- Tabel 3: Gabungan --}}
    {{-- <table>
        <thead>
            <tr>
                <th colspan="9">Rekapitulasi Absensi Halaqoh Gabungan Jami’ah</th>
            </tr>
            <tr>
                <th>Segmen Halaqoh</th>
                <th>Jml. Ahlu Halaqoh</th>
                <th>Jml. Liqo</th>
                <th>Jml. Wajib Hadir</th>
                <th colspan="2">Absen</th>
                <th>Jml</th>
                <th>% Absen</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th>I</th>
                <th>TI</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($halaqohGabungan as $item)
                <tr>
                    <td>{{ $item['segmen'] }}</td>
                    <td>{{ $item['jumlah_ahlu'] }}</td>
                    <td>{{ $item['jumlah_liqo'] }}</td>
                    <td>{{ $item['jumlah_wajib'] }}</td>
                    <td>{{ $item['izin'] }}</td>
                    <td>{{ $item['tanpa_izin'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>{{ $item['persentase'] }}%</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    {{-- Tanda tangan --}}
    <br><br>
    <table class="signature" style="border: none; margin-top: 50px;">
        <tr>
            <td>Daar .............., ........... 1446 H</td>
        </tr>
        <tr>
            <td><strong>Imarotul Muslimin</strong><br>Tadbir Syu’bah ..........</td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%; border: none;">
                    <tr>
                        <td>Amir Syu’bah</td>
                        <td>Amin Bina Syu’bah</td>
                    </tr>
                    <tr>
                        <td height="50"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>................</td>
                        <td>................</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
