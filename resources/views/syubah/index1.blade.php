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


                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Jumlah Tausiyah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tausiyahPerBulan as $item)
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::create($item->tahun, $item->bulan)->translatedFormat('F Y') }}
                                            </td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>
                                                <a href="{{ route('absensi.index', ['bulan' => str_pad($item->bulan, 2, '0', STR_PAD_LEFT), 'tahun' => $item->tahun]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Lihat Detail
                                                </a>
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
