<div class="modal fade" id="modal-member">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Tambah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('member.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama :</label>
                            <input name="name" type="text" class="form-control" id="nama"
                                placeholder="Masukan Nama" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="Nas">Nas :</label>
                            <input name="nas" type="text" class="form-control" id="Nas"
                                placeholder="Masukan Nas" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="Syubah">Syubah :</label>
                            <select class="custom-select" id="Syubah" name="syubah" required>
                                <option value="" disabled selected>-- Pilih Syubah --</option>
                                <option value="AshShidiqqin">AshShidiqqin</option>
                                <option value="AsySyuhada"> AsySyuhada</option>
                                <option value="AshSholihin"> AshSholihin</option>
                                <option value="AlMutaqien"> AlMutaqien</option>
                                <option value="AlMuhsinin"> AlMuhsinin</option>
                                <option value="AshShobirin"> AshShobirin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Holaqoh">Holaqoh :</label>
                            <input name="holaqoh" type="text" class="form-control" id="Holaqoh"
                                placeholder="Masukan Holaqoh" autocomplete="off" required>
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
                            Nas
                        </div>
                        <div class="col-6">
                            : {{ $item->nas }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Syubah
                        </div>
                        <div class="col-6">
                            : {{ $item->syubah }}
                        </div>
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('member.destroy', $item->id) }}" method="POST" class="d-inline">
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
