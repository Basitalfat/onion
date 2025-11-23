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
                                        <th>Holaqoh</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a href="{{ route('member.show', $item->id) }}" class="text-dark" style="cursor: pointer;">
                                                    {{ $item->name }}
                                                </a>
                                            </td>
                                            <td>{{ $item->nas }}</td>
                                            <td>{{ $item->syubah }}</td>
                                            <td>{{ $item->holaqoh ? $item->holaqoh->kode_holaqoh : '-' }}</td>
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    {{-- CSS DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Responsive -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tableUmat').DataTable({
                responsive: true,
                pageLength: 10
            });
            
            // Initialize Select2 for holaqoh dropdown
            $('#holaqoh_id').select2({
                dropdownParent: $('#modal-member'),
                placeholder: '-- Pilih Halaqoh --',
                allowClear: true,
                width: '100%'
            });
            
            // Reset Select2 when modal is closed
            $('#modal-member').on('hidden.bs.modal', function () {
                $('#holaqoh_id').val('').trigger('change');
            });
        });
    </script>
@endpush
