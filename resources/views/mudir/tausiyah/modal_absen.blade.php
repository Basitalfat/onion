{{-- Modal Edit --}}
<div class="modal fade" id="modal-edit{{ $absen->id }}">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Edit {{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('absensi.update', $absen->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body text-left">
                    <div class="mb-3">
                        <strong>Nama:</strong> {{ $absen->member['name'] }}
                    </div>

                    <div class="form-group">
                        <label for="status{{ $absen->id }}">Status</label>
                        <select name="status" id="status{{ $absen->id }}" class="form-control" required>
                            <option value="hadir" {{ $absen->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ $absen->status == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ $absen->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="tanpa_keterangan" {{ $absen->status == 'alfa' ? 'selected' : '' }}>Alfa
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ket{{ $absen->id }}">Keterangan</label>
                        <input type="text" name="ket" id="ket{{ $absen->id }}" class="form-control"
                            value="{{ $absen->ket }}">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
