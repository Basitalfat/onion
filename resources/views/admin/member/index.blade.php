@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success font-weight-bold">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2 mr-2" data-toggle="modal"
                                    data-target="#modal-member">
                                    <i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Umat</span>
                                </a>

                                <a href="{{ route('member.import.form') }}"
                                    class="btn bg-gradient-success btn-sm mb-2 mr-2">
                                    <i class="fas fa-file-import mr-2"></i>
                                    <span class="text-bold">Import Umat</span>
                                </a>

                                <a href="{{ route('memberPdf') }}" class="btn bg-gradient-danger btn-sm mb-2"
                                    target="_blank">
                                    <i class="fas fa-solid fa-file-pdf mr-2"></i>
                                    <span class="text-bold">Export PDF</span>
                                </a>
                            </div>

                            <table id="tableUmat" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nas</th>
                                        <th>Syubah</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a href="#" class="btn-select-umat text-dark"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                                    {{ $item->name }}
                                                </a>
                                            </td>
                                            <td>{{ $item->nas }}</td>
                                            <td>{{ $item->syubah }}</td>
                                            <td width="15%">
                                                <a href="{{ route('member.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-edit m-1"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('admin.member.modal')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card mt-4">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Detail Halaqoh</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2 mr-2" data-toggle="modal"
                                    data-target="#modalTambahHalaqoh">
                                    <i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Holaqoh</span>
                                </a>
                            </div>
                            <form id="formDetailHalaqoh" method="POST" action="{{ route('detail-halaqoh.store') }}">
                                @csrf
                                <input type="hidden" name="member_id" id="inputUmatId">
                            </form>
                            <div id="successMessage" class="alert alert-success d-none"></div>
                            <table id="tableDetailHalaqoh" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Umat</th>
                                        <th>Kode Halaqoh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDetailHalaqoh"></tbody>
                            </table>
                            <div class="modal fade" id="modalPilihHalaqoh" tabindex="-1">
                                <div class="modal-dialog">
                                    <form id="formPilihHalaqoh">
                                        @csrf
                                        <input type="hidden" name="member_id" id="modalUmatId">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Pilih Kode Halaqoh</h5>
                                                <button class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <select name="holaqoh_id" id="selectHalaqoh" class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($holaqoh as $h)
                                                        <option value="{{ $h->id }}"
                                                            data-kode="{{ $h->kode_holaqoh }}"
                                                            data-name="{{ $h->name }}">
                                                            {{ $h->kode_holaqoh }} - {{ $h->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- CSS DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI jika pakai sortable -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tableUmat').DataTable({
                responsive: true,
                pageLength: 10
            });
            let selectedMemberId = null;
            let selectedMemberName = null;

            function renderDetailRow(member, halaqoh) {
                return `
                    <tr id="row-detail-${member.id}">
                        <td>1</td>
                        <td>${member.name}</td>
                        <td id="halaqoh-cell-${member.id}">${halaqoh ? halaqoh.kode_holaqoh + ' - ' + halaqoh.name : 'Belum dipilih'}</td>
                        <td>
                            <button class="btn btn-sm btn-success btn-edit-halaqoh" data-id="${member.id}">Edit</button>
                            <button class="btn btn-sm btn-danger btn-hapus-halaqoh" data-id="${member.id}">Hapus</button>
                        </td>
                    </tr>`;
            }

            $(document).on('click', '.btn-select-umat', function(e) {
                e.preventDefault();
                selectedMemberId = $(this).data('id');
                selectedMemberName = $(this).data('name');
                $('#tbodyDetailHalaqoh').empty();
                $.get(`/api/detail-halaqoh/${selectedMemberId}`, function(response) {
                    const row = renderDetailRow(response.data.member, response.data.halaqoh);
                    $(`#row-detail-${selectedMemberId}`).length ?
                        $(`#row-detail-${selectedMemberId}`).replaceWith(row) :
                        $('#tbodyDetailHalaqoh').append(row);
                }).fail(function() {
                    const row = renderDetailRow({
                        id: selectedMemberId,
                        name: selectedMemberName
                    }, null);
                    $(`#row-detail-${selectedMemberId}`).length ?
                        $(`#row-detail-${selectedMemberId}`).replaceWith(row) :
                        $('#tbodyDetailHalaqoh').append(row);
                });
            });

            $(document).on('click', '.btn-edit-halaqoh', function() {
                $('#modalUmatId').val($(this).data('id'));
                $('#modalPilihHalaqoh').modal('show');
            });

            $('#formPilihHalaqoh').submit(function(e) {
                e.preventDefault();
                const memberId = $('#modalUmatId').val();
                const halaqohId = $('#selectHalaqoh').val();
                if (!memberId || !halaqohId) return alert('Pilih halaqoh terlebih dahulu.');

                $.post({
                    url: '{{ route('detail-halaqoh.store') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        member_id: memberId,
                        holaqoh_id: halaqohId
                    },
                    success: function(res) {
                        const row = renderDetailRow(res.data.member, res.data.halaqoh);
                        $(`#row-detail-${res.data.member.id}`).length ?
                            $(`#row-detail-${res.data.member.id}`).replaceWith(row) :
                            $('#tbodyDetailHalaqoh').append(row);
                        $('#modalPilihHalaqoh').modal('hide');
                        $('#successMessage').text('Berhasil disimpan!').removeClass('d-none')
                            .fadeIn().delay(3000).fadeOut();
                    },
                    error: function(xhr) {
                        alert('Gagal simpan: ' + (xhr.responseJSON?.message ||
                            'Terjadi kesalahan'));
                    }
                });
            });

            $(document).on('click', '.btn-hapus-halaqoh', function() {
                const memberId = $(this).data('id');
                if (!confirm('Yakin ingin menghapus relasi halaqoh ini?')) return;
                $.ajax({
                    url: `/detail-halaqoh/${memberId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $(`#row-detail-${memberId}`).remove();
                        alert('Berhasil dihapus');
                    },
                    error: function() {
                        alert('Gagal menghapus');
                    }
                });
            });
        });
    </script>
@endpush
