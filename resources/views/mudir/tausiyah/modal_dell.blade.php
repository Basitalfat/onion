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
                        <div class="col-6">Tanggal</div>
                        <div class="col-6">: {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Pengisi
                        </div>
                        <div class="col-6">
                            : {{ $item->pengisi }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Tempat
                        </div>
                        <div class="col-6">
                            : {{ $item->tempat }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">Halaqoh</div>
                        <div class="col-6">: {{ $item->holaqoh->kode_holaqoh ?? '-' }} -
                            {{ $item->holaqoh->name ?? '' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">Media</div>
                        <div class="col-6">: {{ ucfirst($item->media) }}</div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('tausiyah.destroy', $item->id) }}" method="POST" class="d-inline">
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
