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
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-outline-light btn-sm text-dark font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-2" data-toggle="modal"
                                    data-target="#modal-tausiyah"><i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Tausiyah</span></a>
                                <a href="#" class="btn bg-gradient-danger btn-sm mb-2"><i
                                        class="fas fa-solid fa-file-pdf mr-2"></i>
                                    <span class="text-bold">Export PDF</span></a>
                            </div>

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Halaqoh</th>
                                        <th>Pengisi</th>
                                        <th>Tempat</th>
                                        <th>Media</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tausiyah as $item)
                                        <tr>
                                            <td>{{ $item->bulan }}</td>
                                            <td>{{ $item->holaqoh->kode_holaqoh ?? '-' }}</td>
                                            <td>{{ $item->pengisi->name }}</td>
                                            <td>{{ $item->tempat }}</td>
                                            <td>{{ ucfirst($item->media) }}</td>
                                            <td width="15%">
                                                <a href="{{ route('tausiyah.show', $item->id) }}" class="btn btn-outline-info btn-xs mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('mudir.tausiyah.modal_dell', ['holaqohs' => $holaqohs])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
    @include('mudir.tausiyah.modal')
@endsection

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('LTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!-- DataTables JS -->
    <script src="{{ asset('LTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('LTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTables with destroy option to prevent reinitialization error
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            
            $('#example1').DataTable({
                "order": [[ 0, "desc" ]], // Urutkan berdasarkan kolom pertama (tanggal) secara descending
                "pageLength": 25,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
            
            // Initialize Select2 for pengisi dropdown
            $('#pengisi_id').select2({
                dropdownParent: $('#modal-tausiyah'),
                placeholder: '-- Pilih Pengisi --',
                allowClear: true,
                width: '100%'
            });
            
            // Initialize Select2 for holaqoh dropdown
            $('#holaqoh_id').select2({
                dropdownParent: $('#modal-tausiyah'),
                placeholder: '-- Pilih Halaqoh --',
                allowClear: true,
                width: '100%'
            });
            
            // Reset Select2 when modal is closed
            $('#modal-tausiyah').on('hidden.bs.modal', function () {
                $('#pengisi_id').val('').trigger('change');
                $('#holaqoh_id').val('').trigger('change');
            });
        });
    </script>
@endpush
