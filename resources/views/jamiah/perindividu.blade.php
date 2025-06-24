@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header bg-info">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm text-dark font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="GET" action="{{ route('rekap.perindividu') }}" class="mb-4">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <label for="tahun" class="col-form-label">Tahun:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="number" name="tahun" id="tahun" class="form-control"
                                            value="{{ $filter_tahun }}" min="2000" max="{{ date('Y') }}">
                                    </div>

                                    <div class="col-auto">
                                        <label for="bulan" class="col-form-label">Bulan:</label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="bulan" id="bulan" class="form-control">
                                            @for ($m = 1; $m <= 12; $m++)
                                                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                                                    {{ $filter_bulan == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <label for="syubah" class="col-form-label">Syubah:</label>
                                    </div>
                                    <div class="col-auto">
                                        <select name="syubah" id="syubah" class="form-control">
                                            <option value="">-- Pilih Syubah --</option>
                                            @foreach ($syubahOptions as $option)
                                                <option value="{{ $option }}"
                                                    {{ isset($filter_syubah) && $filter_syubah == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>

                                    <div class="col-auto">
                                        <a href="{{ route('rekap.perindividu') }}"
                                            class="btn btn-danger no-print">Reset</a>
                                    </div>
                                </div>
                            </form>

                            <!-- Tabel Rekap -->
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Umat</th>
                                        <th>Hadir</th>
                                        <th>Izin</th>
                                        <th>Tanpa Keterangan</th>
                                        <th>Total Absensi</th>
                                        <th>Persentase Absensi (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekap as $item)
                                        <tr>
                                            <td>{{ $item['member']->name }}</td>
                                            <td>{{ $item['hadir'] }}</td>
                                            <td>{{ $item['izin'] }}</td>
                                            <td>{{ $item['tanpa_keterangan'] }}</td>
                                            <td>{{ $item['total'] }}</td>
                                            <td>{{ $item['persentase'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
