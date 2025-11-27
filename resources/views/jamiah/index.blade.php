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
                            <!-- Filter Syubah dan Tombol Export -->
                            <form method="GET" action="{{ route('jamiah.index') }}" class="form-inline mb-3">
                                <label for="syubah" class="mr-2">Filter Syubah:</label>
                                <select name="syubah" id="syubah" class="form-control mr-2">
                                    <option value="">-- Semua Syubah --</option>
                                    @php
                                        $syubahOptions = [
                                            'AshShidiqqin',
                                            'AsySyuhada',
                                            'AshSholihin',
                                            'AlMutaqien',
                                            'AlMuhsinin',
                                            'AshShobirin',
                                        ];
                                    @endphp
                                    @foreach ($syubahOptions as $option)
                                        <option value="{{ $option }}"
                                            {{ request('syubah') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                                <div class="col-auto">
                                    <a href="{{ route('jamiah.index') }}" class="btn btn-danger no-print">Reset</a>
                                </div>

                                <a href="{{ route('jamiah.exportPdf', ['syubah' => request('syubah')]) }}"
                                    class="btn btn-danger ml-2" target="_blank">
                                    <i class="fas fa-file-pdf mr-1"></i> Export PDF
                                </a>
                            </form>

                            <table id="example1" class="table table-bordered table-striped table-hover">
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
                                                <a href="{{ route('jamiah.show', $item->id) }}"
                                                    class="d-block text-decoration-none text-dark">
                                                    {{ $item->holaqoh->syubah }} | {{ $item->pengisi->name }} |
                                                    {{ $item->tempat }}
                                                </a>
                                            </td>
                                            <td>{{ $item->bulan }}</td>
                                            <td>{{ $item->holaqoh->kode_holaqoh }}</td>
                                            <td>
                                                {{ $item->user->name ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
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
