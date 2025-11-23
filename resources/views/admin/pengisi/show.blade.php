@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('LTE/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $pengisi->name }}</h3>

                            <p class="text-muted text-center">{{ $pengisi->syubah }}</p>
                            <p class="text-muted text-center">Mudzakir {{ $pengisi->status }}</p>



                            <a href="#" class="btn btn-success btn-block"><b>Hubungi </b><i
                                    class="fab fa-whatsapp"></i></a>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link">Settings</a>
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
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Name"
                                                    value="{{ old('name', $pengisi->name) }}" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSyubah" class="col-sm-2 col-form-label">Syubah</label>
                                            <div class="col-sm-10">
                                                <select class="form-control custom-select" id="inputSyubah" name="syubah">
                                                    <option value="" disabled {{ !$pengisi->syubah ? 'selected' : '' }}>-- Pilih Syubah --</option>
                                                    <option value="AshShidiqqin" {{ $pengisi->syubah == 'AshShidiqqin' ? 'selected' : '' }}>AshShidiqqin</option>
                                                    <option value="AsySyuhada" {{ $pengisi->syubah == 'AsySyuhada' ? 'selected' : '' }}>AsySyuhada</option>
                                                    <option value="AshSholihin" {{ $pengisi->syubah == 'AshSholihin' ? 'selected' : '' }}>AshSholihin</option>
                                                    <option value="AlMutaqien" {{ $pengisi->syubah == 'AlMutaqien' ? 'selected' : '' }}>AlMutaqien</option>
                                                    <option value="AlMuhsinin" {{ $pengisi->syubah == 'AlMuhsinin' ? 'selected' : '' }}>AlMuhsinin</option>
                                                    <option value="AshShobirin" {{ $pengisi->syubah == 'AshShobirin' ? 'selected' : '' }}>AshShobirin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-control custom-select" id="role" name="status"
                                                    required>
                                                    <option value="" disabled selected>-- Pilih Status --</option>
                                                    <option value="jamiah"
                                                        {{ $pengisi->status == 'jamiah' ? 'selected' : '' }}>
                                                        Jamiah</option>
                                                    <option value="syubah"
                                                        {{ $pengisi->status == 'syubah' ? 'selected' : '' }}>
                                                        Syubah</option>
                                                </select>
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
