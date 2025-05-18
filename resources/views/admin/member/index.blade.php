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
                                    data-target="#modal-member">
                                    <i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Umat</span>
                                </a>
                            
                                <a href="{{ route('member.import.form') }}" class="btn bg-gradient-success btn-sm mb-2 mr-2">
                                    <i class="fas fa-file-import mr-2"></i>
                                    <span class="text-bold">Import Umat</span>
                                </a>
                            
                                <a href="{{ route('memberPdf') }}" class="btn bg-gradient-danger btn-sm mb-2" target="_blank">
                                    <i class="fas fa-solid fa-file-pdf mr-2"></i>
                                    <span class="text-bold">Export PDF</span>
                                </a>
                            </div>                            

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nas</th>
                                        <th>Syubah</th>
                                        <th>Holaqoh</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->nas }}</td>
                                            <td>{{ $item->syubah }}</td>
                                            <td>{{ $item->holaqoh }}</td>
                                            <td width="15%">
                                                <a href="{{ route('member.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-edit m-1"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('admin.member.modal')
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
