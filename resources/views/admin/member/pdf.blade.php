<style>
    body {
        font-family: Arial, sans-serif;
    }

    h1,
    h3 {
        text-align: center;
        margin-bottom: 5px;
    }

    hr {
        border: 1px solid #000;
        margin: 10px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>

<h1>Data Umat</h1>
<h3>Tanggal: {{ $tanggal }}</h3>
<h3>Pukul: {{ $jam }}</h3>
<hr>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Nama</th>
            <th width="30%">Nas</th>
            <th width="20%">Syubah</th>
            <th width="20%">Holaqoh</th>
            <th width="20%">Farah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($member as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->nas }}</td>
                <td>{{ $item->syubah }}</td>
                <td>{{ $item->holaqoh }}</td>
                <td>{{ $item->farah }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
