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
                            <a href="{{ route('absensi.index') }}"
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
                                                <strong>H :</strong> {{ $tausiyah->holaqoh->kode_holaqoh }}
                                            </div>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt"></i> {{ $tausiyah->bulan }}
                                            </small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1"><i class="fas fa-user-edit mr-1"></i><strong>Pengisi:</strong> {{ $tausiyah->pengisi }}</p>
                                                <p class="mb-1"><i class="fas fa-map-marker-alt mr-1"></i><strong>Tempat:</strong> {{ $tausiyah->tempat }}</p>
                                                <p class="mb-1"><i class="fas fa-percentage mr-1"></i><strong>Persentase Absensi:</strong> {{ $persentase_absensi }}%</p>
                                            </div>
                                        
                                            <div class="col-md-4">
                                                <p class="mb-1"><i class="fas fa-users mr-1"></i><strong>Jumlah Wajib Hadir (JWH):</strong> {{ $jwh }}</p>
                                                <p class="mb-1"><i class="fas fa-user-check mr-1"></i><strong>Jumlah Hadir (JH):</strong> {{ $jumlahHadir }}</p>
                                            </div>
                                        
                                            <div class="col-md-4">
                                                <p class="mb-1"><i class="fas fa-user-clock mr-1"></i><strong>Jumlah Izin (JI):</strong> {{ $jumlahIzin }}</p>
                                                <p class="mb-1"><i class="fas fa-question-circle mr-1"></i><strong>Tanpa Keterangan (TK):</strong> {{ $jumlahTanpaKeterangan }}</p>
                                                <p class="mb-1"><i class="fas fa-user-injured mr-1"></i><strong>Jumlah Sakit (JS):</strong> {{ $jumlahSakit }}</p>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensi as $item)
                                        <tr>
                                            <td>{{ $item->member->name }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->ket }}</td>
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
