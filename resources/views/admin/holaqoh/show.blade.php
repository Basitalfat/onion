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
                                                    placeholder="Holaqoh" value="{{ old('kode_holaqoh', $holaqoh->kode_holaqoh) }}"
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
