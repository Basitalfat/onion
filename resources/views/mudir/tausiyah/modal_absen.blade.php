<div class="modal fade" id="modal-tausiyah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Tambah {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="member">Umat :</label>
                            @if ($members->isEmpty())
                                <p class="text-danger">Tidak ada umat yang cocok dengan syarat syubah, holaqoh, dan
                                    farah.</p>
                            @else
                                <select class="custom-select" id="member" name="member_id" required>
                                    <option value="" disabled selected>-- Pilih Umat --</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select class="custom-select" id="status" name="status" required>
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="tanpa_keterangan">Tanpa Keterangan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ket">Keterangan (opsional) :</label>
                            <textarea name="ket" class="form-control" id="ket" placeholder="Masukan keterangan" rows="4"></textarea>

                            <input name="tausiyah_id" type="hidden" value="{{ $tausiyah->id }}" required>
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
{{-- <div class="modal fade" id="modal-del{{ $item->id }}">
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
</div> --}}
