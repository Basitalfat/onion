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
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-outline-light btn-sm text-dark font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2" data-toggle="modal"
                                    data-target="#modal-tausiyah"><i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Tausiyah</span></a>
                                <a href="#" class="btn bg-gradient-danger btn-sm mb-2"><i
                                        class="fas fa-solid fa-file-pdf mr-2"></i>
                                    <span class="text-bold">Export PDF</span></a>
                            </div>

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tausiyah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tausiyah as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ route('tausiyah.show', $item->id) }}"
                                                    class="d-block text-decoration-none text-dark">
                                                    {{ $item->bulan }} |
                                                    {{ $item->holaqoh->kode_holaqoh ?? '-' }} | {{ $item->pengisi->name }} |
                                                    {{ $item->tempat }} | {{ ucfirst($item->media) }}
                                                </a>
                                            </td>
                                            <td width="15%">
                                                {{-- <a href="{{ route('tausiyah.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-edit m-1"></i>
                                                </a> --}}
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('mudir.tausiyah.modal_dell', ['holaqohs' => $holaqohs])
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
    @include('mudir.tausiyah.modal')
@endsection
