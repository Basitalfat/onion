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

                            <h3 class="profile-username text-center">{{ $member->name }}</h3>

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
                                    <form action="#" method="POST" class="form-horizontal" onsubmit="handleSubmit()">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Name"
                                                    value="{{ old('name', $member->name) }}" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nas" class="col-sm-2 col-form-label">Nas</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nas" placeholder="Nas"
                                                    value="{{ old('nas', $member->nas) }}" name="nas">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Syubah</label>
                                            <div class="col-sm-10">
                                                <select class="form-control custom-select" id="role" name="syubah"
                                                    required>
                                                    <option value="" disabled selected>-- Pilih Syubah --</option>
                                                    <option value="AshShidiqqin"
                                                        {{ $member->syubah == 'AshShidiqqin' ? 'selected' : '' }}>
                                                        AshShidiqqin</option>
                                                    <option value="AsySyuhada"
                                                        {{ $member->syubah == 'AsySyuhada' ? 'selected' : '' }}>
                                                        AsySyuhada</option>
                                                    <option value="AshSholihin"
                                                        {{ $member->syubah == 'AshSholihin' ? 'selected' : '' }}>
                                                        AshSholihin</option>
                                                    <option value="AlMutaqien"
                                                        {{ $member->syubah == 'AlMutaqien' ? 'selected' : '' }}>
                                                        AlMutaqien</option>
                                                    <option value="AlMuhsinin"
                                                        {{ $member->syubah == 'AlMuhsinin' ? 'selected' : '' }}>
                                                        AlMuhsinin</option>
                                                    <option value="AshShobirin"
                                                        {{ $member->syubah == 'AshShobirin' ? 'selected' : '' }}>
                                                        AshShobirin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="holaqoh_id" class="col-sm-2 col-form-label">Holaqoh</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" id="holaqoh_id" name="holaqoh_id">
                                                    <option value="">-- Pilih Halaqoh --</option>
                                                    @foreach ($holaqohs as $holaqoh)
                                                        <option value="{{ $holaqoh->id }}" 
                                                            {{ $member->holaqoh_id == $holaqoh->id ? 'selected' : '' }}>
                                                            {{ $holaqoh->kode_holaqoh }} - {{ $holaqoh->name }}
                                                        </option>
                                                    @endforeach
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

@push('scripts')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2 for holaqoh dropdown
            $('#holaqoh_id').select2({
                placeholder: '-- Pilih Halaqoh --',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
