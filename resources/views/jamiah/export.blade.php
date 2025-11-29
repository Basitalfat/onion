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

        /* Add grey background for headers */
        thead th,
        tfoot th {
            background-color: #d3d3d3;
        }

        /* Row headers (leftmost column) */
        tbody th {
            background-color: #d3d3d3;
            font-weight: bold;
        }

        /* Header with logo and text */
        .header {
            display: flex;
            align-items: center;
            /* Sejajarkan logo + teks vertikal */
            position: relative;
            min-height: 80px;
            padding-bottom: 10px;
        }

        .logo-container {
            width: 80px;
            display: flex;
            align-items: center;
        }

        .logo-container img {
            width: 100%;
            height: auto;
            max-height: 60px;
        }

        .header-text {
            display: flex;
            /* penting! */
            flex-direction: column;
            justify-content: center;
            /* tengah vertikal */
            text-align: right;
            flex-grow: 1;
            padding: 0 20px;
        }

        .header-title,
        .header-subtitle {
            margin: 0;
        }

        .header-title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18px;
            font-weight: bold;
        }

        .header-subtitle {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin-top: 3px;
        }

        .header-line {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #000;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo-container">
            <img src="{{ base_path('public/LTE/dist/img/logo.png') }}" alt="Logo">
        </div>
        <div class="header-text">
            <div class="header-title">Imarotul Muslimin</div>
            <div class="header-subtitle">TADBIR SYU'BAH {{ $syubah }}</div>
        </div>
        <div class="header-line"></div>
    </div>

    <div style="text-align: center; margin: 10px 0 20px 0;">
        <p><strong><u>IKHBAR SYAHRIYAH QISMU BINA</u></strong><br>No. Syu.../U/.../Xx....</p>
        <p>Syahr : {{ strtoupper($bulan) }} {{ $tahun }} H</p>
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

    {{-- Combined Table: Rekap Kehadiran and Kode Mudzakkir --}}
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Mudz. Syu’bah</th>
                <th>Mudz. Jami’ah</th>
                <th>Total</th>
                <th>Kode Mudzakkir Jami’ah Absen / Frekuensi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Terjadwal</th>
                <td>{{ $attendanceRecap['terjadwal']['syubah'] }}</td>
                <td>{{ $attendanceRecap['terjadwal']['jamiah'] }}</td>
                <td>{{ $attendanceRecap['terjadwal']['total'] }}</td>
                <td rowspan="4">&nbsp;</td>
            </tr>
            <tr>
                <th>Hadir</th>
                <td>{{ $attendanceRecap['hadir']['syubah'] }}</td>
                <td>{{ $attendanceRecap['hadir']['jamiah'] }}</td>
                <td>{{ $attendanceRecap['hadir']['total'] }}</td>
            </tr>
            <tr>
                <th>Absen</th>
                <td>{{ $attendanceRecap['absen']['syubah'] }}</td>
                <td>{{ $attendanceRecap['absen']['jamiah'] }}</td>
                <td>{{ $attendanceRecap['absen']['total'] }}</td>
            </tr>
            <tr>
                <th>Prosentase</th>
                <td>{{ $attendanceRecap['percentage']['syubah'] }}%</td>
                <td>{{ $attendanceRecap['percentage']['jamiah'] }}%</td>
                <td>{{ $attendanceRecap['percentage']['total'] }}%</td>
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
            <td>Daar {{ $syubah }}, {{ strtoupper($bulan) }} {{ $tahun }} H</td>
        </tr>
        <tr>
            <td><strong>Imarotul Muslimin</strong><br>Tadbir Syu’bah {{ $syubah }}</td>
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
