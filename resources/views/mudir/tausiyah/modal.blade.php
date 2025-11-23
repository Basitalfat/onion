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
                <form action="{{ route('tausiyah.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal :</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="pengisi_id">Pengisi:</label>
                            <select name="pengisi_id" id="pengisi_id" class="form-control select2" required>
                                <option value="" disabled selected>-- Pilih Pengisi --</option>
                                @foreach ($pengisi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('pengisi_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tempat">Tempat :</label>
                            <input type="text" name="tempat" class="form-control" value="{{ old('tempat') }}"
                                required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="holaqoh_id">Halaqoh</label>
                            <select name="holaqoh_id" id="holaqoh_id" class="form-control select2" required>
                                <option value="">-- Pilih Halaqoh --</option>
                                @foreach ($holaqohs as $holaqoh)
                                    <option value="{{ $holaqoh->id }}"
                                        {{ old('holaqoh_id') == $holaqoh->id ? 'selected' : '' }}>
                                        {{ $holaqoh->kode_holaqoh }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="media">Media</label>
                            <select name="media" class="form-control" required>
                                <option value="">-- Pilih Media --</option>
                                <option value="offline" {{ old('media') == 'offline' ? 'selected' : '' }}>Offline
                                </option>
                                <option value="online" {{ old('media') == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="hybrid" {{ old('media') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
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
