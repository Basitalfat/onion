<!DOCTYPE html>
<html>

<head>
    <title>IKHBAR SYAHRIYAH QISMU BINA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }

        .no-border {
            border: none;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
        }

        .signature td {
            text-align: center;
            border: none;
            padding-top: 40px;
        }
    </style>
</head>

<body>
    <h4>Imarotul Muslimin</h4>
    <h4>TADBIR SYU'BAH {{ strtoupper(request('syubah')) }}</h4>
    <h2>IKHBAR SYAHRIYAH QISMU BINA</h2>
    <p style="text-align: center">No. Sy.../U/.../X....</p>
    <p style="text-align: center">Syahr : RAMADHAN {{ request('tahun_hijriah') }}</p>
    <p style="text-align: center">Bulan : {{ $bulan ?? '...' }}</p>

    <h4>Rekapitulasi Absensi Halaqoh Reguler</h4>
    <table>
        <thead>
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
                <th>Jml</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalWajibHadir = 0;
                $totalIzin = 0;
                $totalTanpaKeterangan = 0;
            @endphp

            @foreach ($rekap as $data)
                @php
                    $anggota = $data['anggota'];
                    $liqo = $data['liqo'];
                    $jwh = $data['jwh'];
                    $izin = $data['izin'];
                    $tk = $data['tanpa_ket'];
                    $total_absen = $data['total_absen'];
                    $persen = $data['persentase'];

                    $totalWajibHadir += $jwh;
                    $totalIzin += $izin;
                    $totalTanpaKeterangan += $tk;
                @endphp
                <tr>
                    <td>{{ $data['kode'] }}</td>
                    <td>{{ $anggota }}</td>
                    <td>{{ $liqo }}</td>
                    <td>{{ $jwh }}</td>
                    <td>{{ $izin }}</td>
                    <td>{{ $tk }}</td>
                    <td>{{ $total_absen }}</td>
                    <td>{{ $persen }}%</td>
                </tr>
            @endforeach

            @php
                $totalAbsen = $totalIzin + $totalTanpaKeterangan;
                $totalPersen = $totalWajibHadir > 0 ? round(($totalAbsen / $totalWajibHadir) * 100, 2) : 0;
            @endphp

            <tr>
                <td colspan="4">Total</td>
                <td>{{ $totalIzin }}</td>
                <td>{{ $totalTanpaKeterangan }}</td>
                <td>{{ $totalAbsen }}</td>
                <td>{{ $totalPersen }}%</td>
            </tr>
        </tbody>
    </table>

    <h4>Rekap Absensi Mudzakkir</h4>
    <table>
        <thead>
            <tr>
                <th>Mudz. Syu'bah</th>
                <th>Mudz. Jamiah</th>
                <th>Total</th>
                <th>Kode Mudzakkir Jam'iah Absen / Frekwensi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Terjadwal</td>
                <td>Hadir</td>
                <td>Absen</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Presentase</td>
                <td>%</td>
            </tr>
        </tbody>
    </table>

    <br>
    <table class="signature">
        <tr>
            <td>Daar ..............., .......... 1446 H</td>
        </tr>
        <tr>
            <td>Imarotul Muslimin<br>Tadbir Syu'bah {{ strtoupper(request('syubah')) }}</td>
        </tr>
        <tr>
            <td>Amir Syu'bah
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Amin Bina Syu'bah</td>
        </tr>
        <tr>
            <td>( .............. )
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ( .............. )</td>
        </tr>
    </table>
</body>

</html>
