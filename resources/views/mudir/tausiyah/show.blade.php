@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header bg-info ">
                            <a href="{{ route('tausiyah.index') }}"
                                class="btn btn-outline-light btn-sm text-dark font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>

                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="callout callout-info py-3 px-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <strong>H :</strong> {{ $tausiyah->holaqoh->kode_holaqoh ?? '-' }}
                                            </div>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt"></i> {{ $tausiyah->bulan }}
                                            </small>
                                        </div>

                                        <!-- Row 1 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-user-edit mr-1"></i>
                                                    <strong>Pengisi:</strong> {{ $tausiyah->pengisi->name }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                                    <strong>Tempat:</strong> {{ $tausiyah->tempat }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-newspaper mr-1"></i>
                                                    <strong>Media:</strong> {{ $tausiyah->media }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-percentage mr-1"></i>
                                                    <strong>Persentase Absensi:</strong> {{ $persentase_absensi }}%
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-users mr-1"></i>
                                                    <strong>Jumlah Hadir:</strong> {{ $jumlahHadir }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-user-check mr-1"></i>
                                                    <strong>Izin:</strong> {{ $jumlahIzin }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Row 3 -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-user-times mr-1"></i>
                                                    <strong>Tanpa Keterangan:</strong> {{ $jumlahTanpaKeterangan }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <i class="fas fa-user-md mr-1"></i>
                                                    <strong>Sakit:</strong> {{ $jumlahSakit }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-0">
                                                    <i class="fas fa-calculator mr-1"></i>
                                                    <strong>Jumlah Wajib Hadir:</strong> {{ $jwh }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $absen)
                                        <tr>
                                            <td>{{ $absen->member['name'] ?? '-' }}</td>
                                            <td>{{ $absen->status ?? '-' }}</td>
                                            <td>{{ $absen->ket ?? '-' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-outline-info btn-xs" data-toggle="modal"
                                                    data-target="#modal-edit{{ $absen->id }}"><i
                                                        class="fas fa-edit m-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('mudir.tausiyah.modal_absen')
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
