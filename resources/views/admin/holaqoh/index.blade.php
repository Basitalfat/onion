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
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2 mr-2" data-toggle="modal"
                                    data-target="#modal-holaqoh">
                                    <i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Data Halaqoh</span>
                                </a>
                            </div>                            

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Holaqoh</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;   
                                    @endphp
                                    @foreach ($holaqoh as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->kode_holaqoh }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td width="15%">
                                                <a href="{{ route('holaqoh.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-edit m-1"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('admin.holaqoh.modal')
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

    <div class="modal fade" id="modal-holaqoh">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Tambah {{ $title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('holaqoh.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Holaqoh">Kode Holaqoh :</label>
                                <input name="kode_holaqoh" type="text" class="form-control" id="Holaqoh"
                                placeholder="Masukan Holaqoh" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama :</label>
                                <input name="name" type="text" class="form-control" id="nama"
                                    placeholder="Masukan Nama" autocomplete="off" required>
                            </div>
    
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
    
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection