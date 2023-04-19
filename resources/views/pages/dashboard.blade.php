@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pemasukan tunai hari ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pemasukan tempo hari ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pemasukan non-tunai hari ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pemasukan hari ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pemasukan bulan ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-navy">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pemasukan tahun ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pengeluaran hari ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pengeluaran bulan ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-navy">
                    <div class="inner">
                        <h2>Rp. 0,-</h2>

                        <i>Pengeluaran tahun ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-lightblue">
                    <div class="inner">
                        <h2>0</h2>

                        <i>Barang Masuk Hari Ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h2>0</h2>

                        <i>Barang Keluar Hari Ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h2>0</h2>

                        <i>Barang Terjual Hari Ini</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>0</h2>

                        <i>Jumlah Produk</i>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-navy">
            <div class="card-header">
                <h3 class="card-title">Grafik Keuangan Tahun 0</h3>
            </div>
            <div class="card-body">
                <div class="col-sm-12" id="container"></div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@push('style')
<style type="text/css">
    .highcharts-figure, .highcharts-data-table table {
        min-width: 360px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
@endpush

@push('script')
<script src="{{ asset('plugins/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('plugins/highcharts/series-label.js') }}"></script>
<script src="{{ asset('plugins/highcharts/exporting.js') }}"></script>
<script src="{{ asset('plugins/highcharts/export-data.js') }}"></script>
<script src="{{ asset('plugins/highcharts/accessibility.js') }}"></script>
@endpush