<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Tambah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama :</label>
                            <input name="name" type="text" class="form-control" id="nama"
                                placeholder="Masukan Nama" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email :</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                placeholder="Masukan email" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="syubah">Syubah :</label>
                            <select class="custom-select" id="syubah" name="syubah" required>
                                <option value="" disabled selected>-- Pilih Syubah --</option>
                                <option value="AshShidiqqin">AshShidiqqin</option>
                                <option value="AsySyuhada">AsySyuhada</option>
                                <option value="AshSholihin">AshSholihin</option>
                                <option value="AlMutaqien">AlMutaqien</option>
                                <option value="AlMuhsinin">AlMuhsinin</option>
                                <option value="AshShobirin">AshShobirin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="custom-select" id="role" name="role" required>
                                <option value="" disabled selected>-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="jamiah">Jamiah</option>
                                <option value="syubah">Syubah</option>
                                <option value="mudir">Mudir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input name="password" type="password" class="form-control" id="password"
                                placeholder="Masukan Password" required>
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi password">Konfirmasi Password :</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                id="konfirmasi password" placeholder="Konfirmasi Password" required>
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

{{-- modal dellet --}}
<div class="modal fade" id="modal-del{{ $item->id }}">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Hapus {{ $title }} ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-6">
                            Nama
                        </div>
                        <div class="col-6">
                            : {{ $item->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Email
                        </div>
                        <div class="col-6">
                            : {{ $item->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Role
                        </div>
                        <div class="col-6">
                            :
                            @if ($item->is_admin == true)
                                <span class="badge badge-success badge-pill">
                                    Admin
                                </span>
                            @else
                                <span class="badge badge-dark badge-pill">
                                    Pengguna
                                </span>
                            @endif

                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Data</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-xs"
                                                    data-toggle="modal" data-target="modal-delete{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i></button>
                                                </form> --}}
