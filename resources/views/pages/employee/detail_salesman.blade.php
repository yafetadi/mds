@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Sales</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-success float-right" href="{{ route('salesman.list') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td style="background-color: whitesmoke;">Nama</tde=>
                                <td style="font-style: italic;">{{ $salesman->name }}</td>
                                <td style="background-color: whitesmoke;">Telepon</td>
                                <td style="font-style: italic;">{{ $salesman->phone }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke;">Cabang</td>
                                <td style="font-style: italic;">{{ $salesman->branch->name }}</td>
                                <td style="background-color: whitesmoke;">Area</td=>
                                <td style="font-style: italic;">{{ $salesman->area->name }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke;">Alamat</td>
                                <td colspan="3" style="font-style: italic;">{{ $salesman->address }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Jumlah Transaksi</td>
                                <td style="font-style: italic;" colspan="2">{{ $total_order }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Total Nominal Transaksi</td>
                                <td style="font-style: italic;" colspan="2">Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_grandtotal )),3))) }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Total Nominal Piutang</td>
                                <td style="font-style: italic;" colspan="2">Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_remaining )),3))) }}</td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; font-weight: bold;" colspan="2">Persentase Penjualan</td>
                                <td style="font-style: italic;" colspan="2">{{ round($percentage, 2) }} %</td>
                            </tr>
                        </table>

                        <form method="GET" action="{{ url()->current() }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <select class="form-control" name="filter" id="filter">
                                            <option disabled selected>== Pilih Tanggal ==</option>
                                            <option value="Hari Ini">Hari Ini</option>
                                            <option value="Tanggal">Tanggal</option>
                                            <option value="Bulan">Bulan</option>
                                            <option value="Tahun">Tahun</option>
                                            <option value="custom">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="date_choice">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" id="date_selected" name="date_selected" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="month_choice">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Bulan</label>
                                                <select id="month_selected" name="month_selected" class="form-control">
                                                    <option disabled selected>== Pilih Bulan ==</option>
                                                    @foreach($months as $no => $month)
                                                    <option value="{{ $no }}">{{ $month }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="year_choice">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <select id="year_selected" name="year_selected" class="form-control">
                                                    <option disabled selected>== Pilih Tahun ==</option>
                                                    {{ $now = date('Y'); }}
                                                    @for($year = 2023; $year <= $now; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="date_range">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dari Tanggal</label>
                                                <input type="date" id="date_start" name="date_start" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sampai Tanggal</label>
                                                <input type="date" id="date_end" name="date_end" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="col-sm-12">
                                        <label>&nbsp;</label>
                                    </div>
                                    <div class="btn-group col-sm-12">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-default" href="{{ route('salesman.detail', $salesman->id) }}"><i class="fas fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Daftar Transaksi Pelanggan:</label>
                                <span>@if(request()->get('filter') != 'custom') {{ request()->get('filter') }} ({{ $date }}) @elseif (request()->get('filter') == 'custom') ({{ $date }}) @endif </span>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Perusahaan</th>
                                    <th>Jumlah</th>
                                    <th>Total Nominal</th>
                                    <th><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $customer->company }}</td>
                                    <td>{{ $customer->count }}</td>
                                    <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $customer->total )),3))) }}</td>
                                    <td><button class="btn btn-sm btn-info" onclick="getDetail('{{ $customer->id }}')"><i class="fa fa-search"></i></button></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><center>Tidak ada data</center></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal Detail Salesman -->
<div class="modal fade" id="modalDetail">
    <div id="imported-page"></div>            
</div>
<!-- /.modal-edit-salesman -->
@endsection
@push('script')
<script>
    function getDetail(id) {
        $.get("{{ url('/get-salesman-detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalDetail").modal('show');
        });
    }

    $(document).ready(function() {
        $('#date_range').hide();
        $('#date_choice').hide();
        $('#month_choice').hide();
        $('#year_choice').hide();

        $('#filter').change(function () {
            if($('#filter').val() == 'custom') {
                $('#date_range').show();
            } else {
                $('#date_range').hide();
                $('#date_start').val() == null;
                $('#date_end').val() == null;
            }

            if($('#filter').val() == 'Tanggal') {
                $('#date_choice').show();
            } else {
                $('#date_choice').hide();
                $('#date_selected').val() == null;
            }

            if($('#filter').val() == 'Bulan') {
                $('#month_choice').show();
            } else {
                $('#month_choice').hide();
                $('#month_selected').val() == null;
            }

            if($('#filter').val() == 'Tahun') {
                $('#year_choice').show();
            } else {
                $('#year_choice').hide();
                $('#year_selected').val() == null;
            }
        });
    });
</script>
@endpush