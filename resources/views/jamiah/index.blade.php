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
                            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm text-dark font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">


                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tausiyah</th>
                                        <th>Waktu</th>
                                        <th>Holaqoh</th>
                                        <th>Mudir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tausiyah as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ route('jamiah.show', $item->id) }}"
                                                    class="d-block text-decoration-none text-dark">
                                                    {{ $item->user->syubah }} | {{ $item->pengisi }} | {{ $item->tempat }}
                                                </a>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->holaqoh }}</td>
                                            <td>
                                                {{ $item->user->name ?? '-' }}
                                            </td>
                                        </tr>
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
@endsection
