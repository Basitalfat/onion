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

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">Software Engineer</p>



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
                                    <form action="{{ route('user.update', $user->id) }}" method="POST"
                                        class="form-horizontal" onsubmit="handleSubmit()">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Name"
                                                    value="{{ old('name', $user->name) }}" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email" value="{{ old('email', $user->email) }}"
                                                    name="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Role</label>
                                            <div class="col-sm-10">
                                                <select class="form-control custom-select" id="role" name="role"
                                                    required>
                                                    <option value="" disabled selected>-- Pilih Role --</option>
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                    <option value="jamiah" {{ $user->role == 'jamiah' ? 'selected' : '' }}>
                                                        jamiah</option>
                                                    <option value="syubah" {{ $user->role == 'syubah' ? 'selected' : '' }}>
                                                        syubah</option>
                                                    <option value="mudir" {{ $user->role == 'mudir' ? 'selected' : '' }}>
                                                        mudir</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Syubah</label>
                                            <div class="col-sm-10">
                                                <select class="form-control custom-select" id="syubah" name="syubah"
                                                    required>
                                                    <option value="" disabled selected>-- Pilih Syubah --</option>
                                                    <option value="AshShidiqqin"
                                                        {{ $user->syubah == 'AshShidiqqin' ? 'selected' : '' }}>
                                                        AshShidiqqin</option>
                                                    <option value="AsySyuhada"
                                                        {{ $user->syubah == 'AsySyuhada' ? 'selected' : '' }}>
                                                        AsySyuhada</option>
                                                    <option value="AshSholihin"
                                                        {{ $user->syubah == 'AshSholihin' ? 'selected' : '' }}>
                                                        AshSholihin</option>
                                                    <option value="AlMutaqien"
                                                        {{ $user->syubah == 'AlMutaqien' ? 'selected' : '' }}>
                                                        AlMutaqien</option>
                                                    <option value="AlMuhsinin"
                                                        {{ $user->syubah == 'AlMuhsinin' ? 'selected' : '' }}>
                                                        AlMuhsinin</option>
                                                    <option value="AshShobirin"
                                                        {{ $user->syubah == 'AshShobirin' ? 'selected' : '' }}>
                                                        AshShobirin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPasword" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPasword"
                                                    autocomplete="new-password" placeholder="Password Baru" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="konfirPasword" class="col-sm-2 col-form-label">Konfirmasi
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="konfirPasword"
                                                    autocomplete="new-password" placeholder="Konfirmasi Password"
                                                    name="password_confirmation">
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

@push('scripts')
    <script>
        function handleSubmit() {
            var button = document.getElementById('submitButton');
            button.disabled = true;
            button.innerHTML = `
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...
    `;
        }
    </script>
@endpush
