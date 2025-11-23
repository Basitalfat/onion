@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link">Edit Data Halaqoh</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div>
                                    <form action="#" method="POST" class="form-horizontal" onsubmit="handleSubmit()">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="holaqoh" class="col-sm-2 col-form-label">Kode Holaqoh :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="kode_holaqoh"
                                                    placeholder="Holaqoh"
                                                    value="{{ old('kode_holaqoh', $holaqoh->kode_holaqoh) }}"
                                                    name="kode_holaqoh">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama Halaqoh :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Name"
                                                    value="{{ old('name', $holaqoh->name) }}" name="name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger" id="submitButton">Simpan
                                                    Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2 mr-2" data-toggle="modal"
                                    data-target="#modal-holaqoh">
                                    <i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Umat Halaqoh</span>
                                </a>
                            </div>

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>

                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($detail_holaqoh as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->member->name }}</td>
                                            <td width="15%">
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('admin.holaqoh.modaldetail')
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <div class="modal fade" id="modal-holaqoh">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Tambah Umat Holaqoh {{ $holaqoh->kode_holaqoh }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('detailholaqoh.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="holaqoh_id" value="{{ $holaqoh->id }}">
                            <div class="form-group">
                                <label for="member_id">Pilih Nama:</label>
                                <select name="member_id" id="member_id" class="form-control select2" required>
                                    <option value="">-- Pilih Member --</option>
                                    @foreach ($members as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->syubah }}</option>
                                    @endforeach
                                </select>
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

@push('scripts')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2 for member dropdown
            $('#member_id').select2({
                dropdownParent: $('#modal-holaqoh'),
                placeholder: '-- Pilih Member --',
                allowClear: true,
                width: '100%'
            });
            
            // Reset Select2 when modal is closed
            $('#modal-holaqoh').on('hidden.bs.modal', function () {
                $('#member_id').val('').trigger('change');
            });
        });
    </script>
@endpush
