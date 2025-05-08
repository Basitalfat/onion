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
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2" data-toggle="modal"
                                    data-target="#modal-lg"><i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah User</span></a>
                                <a href="{{ route('userPdf') }}" class="btn bg-gradient-danger btn-sm mb-2"
                                    target="_blank"><i class="fas fa-solid fa-file-pdf mr-2"></i>
                                    <span class="text-bold">Export PDF</span></a>
                            </div>

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center">
                                                @if ($item->role == 'admin')
                                                    <span class="badge badge-primary badge-pill"><i
                                                            class="fas fa-solid fa-crown"></i> Admin</span>
                                                @elseif($item->role == 'jamiah')
                                                    <span class="badge badge-warning badge-pill"><i
                                                            class="fas fa-solid fa-user-tie"></i> Jamiah</span>
                                                @elseif($item->role == 'syubah')
                                                    <span class="badge badge-success badge-pill"><i
                                                            class="fas fa-solid fa-user-tie"></i> Syubah</span>
                                                @else
                                                    <span class="badge badge-info badge-pill"><i
                                                            class="fas fa-solid fa-user-tie"></i> Mudir</span>
                                                @endif
                                            </td>
                                            <td width="15%">
                                                <a href="{{ route('user.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-edit m-1"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('admin.user.modal')
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
