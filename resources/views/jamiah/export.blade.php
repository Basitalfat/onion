<!DOCTYPE html>
<html>

<head>
    <title>Laporan Tausiyah</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
        }

        p.total {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <h2>Laporan Tausiyah</h2>
    <p class="total">Total tausiyah: {{ $tausiyah->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>Tausiyah</th>
                <th>Waktu</th>
                <th>Holaqoh</th>
                <th>Mudir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tausiyah as $item)
                <tr>
                    <td>
                        {{ $item->user->syubah ?? '-' }} | 
                        {{ $item->pengisi ?? '-' }} | 
                        {{ $item->tempat ?? '-' }}
                    </td>
                    <td>
                        {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                    </td>
                    <td>{{ $item->holaqoh ?? '-' }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
