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
                                    data-target="#modal-pengisi">
                                    <i class="fas fa-solid fa-user-plus mr-2"></i>
                                    <span class="text-bold">Tambah Mudzakir</span>
                                </a>

                                <a href="{{ route('member.import.form') }}"
                                    class="btn bg-gradient-success btn-sm mb-2 mr-2">
                                    <i class="fas fa-file-import mr-2"></i>
                                    <span class="text-bold">Import Mudzakir</span>
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
                                        <th width="10%">No</th>
                                        <th>Nama</th>
                                        <th>Syubah</th>
                                        <th>Status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengisi as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a href="#" class="btn-select-umat text-dark"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                                    {{ $item->name }}
                                                </a>
                                            </td>
                                            <td>{{ $item->syubah }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td width="15%">
                                                <a href="{{ route('pengisi.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-xs">
                                                    <i class="fas fa-edit m-1"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-xs" data-toggle="modal"
                                                    data-target="#modal-del{{ $item->id }}"><i
                                                        class="fas fa-trash m-1"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('admin.pengisi.modal')
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Responsive -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tableUmat').DataTable({
                responsive: true,
                pageLength: 10
            });
        });
    </script>
@endpush
