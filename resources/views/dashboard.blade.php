@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jumlahAdmin }}</h3>
                            <p>admin</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $jumlahPengguna }}</h3>

                            <p>Jumlah Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $jumlahMember }}</h3>

                            <p>Jumlah Member</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Chart Pie Admin vs Pengguna -->
                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Diagram Admin vs Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="userChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Chart Line Pengguna per Hari -->
                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title">User per Hari</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="userPerhari" width="400" height="400"></canvas>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.row (main row) -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Pie Admin vs Pengguna
        const ctx1 = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Admin', 'Pengguna'],
                datasets: [{
                    label: 'Jumlah User',
                    data: [{{ $jumlahAdmin }}, {{ $jumlahPengguna }}],
                    backgroundColor: [
                        'rgba(23, 162, 184)', // Admin (info)
                        'rgba(40, 167, 69)' // Pengguna (success)
                    ],
                    borderColor: [
                        'rgba(23, 162, 184, 1)',
                        'rgba(40, 167, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });

        // Chart Line Pengguna per Hari
        const ctx2 = document.getElementById('userPerhari').getContext('2d');
        const userPerhari = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: {!! json_encode($usersPerDay->pluck('date')) !!},
                datasets: [{
                    label: 'User',
                    data: {!! json_encode($usersPerDay->pluck('total')) !!},
                    backgroundColor: 'rgba(40, 167, 69, 0.2)', // success color transparan
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endpush
