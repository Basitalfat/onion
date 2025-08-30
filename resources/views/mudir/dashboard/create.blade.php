@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2 bg-info">
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-outline-light btn-sm text-dark font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div>
                                    <form action="{{ route('tausiyah.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="tanggal" class="form-control"
                                                    value="{{ old('tanggal') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pengisi_id" class="col-sm-2 col-form-label">Pengisi :</label>
                                            <div class="col-sm-10">
                                                <select name="pengisi_id" id="pengisi_id" class="form-control" required>
                                                    <option value="" disabled selected>-- Pilih Pengisi --</option>
                                                    @foreach ($pengisi as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('pengisi_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tempat :</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tempat" class="form-control"
                                                    value="{{ old('tempat') }}" required autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Halaqoh :</label>
                                            <div class="col-sm-10">
                                                <select name="holaqoh_id" class="form-control" required>
                                                    <option value="">-- Pilih Halaqoh --</option>
                                                    @foreach ($holaqohs as $holaqoh)
                                                        <option value="{{ $holaqoh->id }}"
                                                            {{ old('holaqoh_id') == $holaqoh->id ? 'selected' : '' }}>
                                                            {{ $holaqoh->kode_holaqoh }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Media :</label>
                                            <div class="col-sm-10">
                                                <select name="media" class="form-control" required>
                                                    <option value="">-- Pilih Media --</option>
                                                    <option value="offline"
                                                        {{ old('media') == 'offline' ? 'selected' : '' }}>Offline
                                                    </option>
                                                    <option value="online"
                                                        {{ old('media') == 'online' ? 'selected' : '' }}>Online</option>
                                                    <option value="hybrid"
                                                        {{ old('media') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger" id="submitButton">Simpan
                                                    Tausiyah</button>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
