@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Penjualan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            Filter Laporan
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="GET" action="{{ url()->current() }}">
                <div class="row">
                    @can('isOwner')
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Cabang</label>
                            <select class="form-control" name="branch">
                                <option disabled>== Pilih Cabang ==</option>
                                @if(Auth::user()->role == 'Owner')
                                    <option value="" {{ request('branch_id') == 'NULL' ? 'selected' : '' }}>Semua Cabang</option>
                                @endif
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>{{ $branch->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endcan
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <select class="form-control" name="filter" id="filter">
                                <option disabled {{ request('filter') == null ? 'selected' : '' }}>== Pilih Tanggal ==</option>
                                <option value="Hari Ini" {{ request('filter') == 'Hari Ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="Tanggal" {{ request('filter') == 'Tanggal' ? 'selected' : '' }}>Tanggal</option>
                                <option value="Bulan" {{ request('filter') == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                                <option value="Tahun" {{ request('filter') == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                                <option value="custom" {{ request('filter') == 'custom' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="date_choice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" id="date_selected" name="date_selected" class="form-control" value="{{ request('date_selected') == null ? '' : request('date_selected') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" id="month_choice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select id="month_selected" name="month_selected" class="form-control">
                                        <option disabled {{ request('month_selected') == null ? 'selected' : '' }}>== Pilih Bulan ==</option>
                                        @foreach($months as $no => $month)
                                        <option value="{{ $no }}" {{ request('month_selected') == $no ? 'selected' : '' }}>{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" id="year_choice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select id="year_selected" name="year_selected" class="form-control">
                                        <option disabled {{ request('year_selected') == null ? 'selected' : '' }}>== Pilih Tahun ==</option>
                                        {{ $now = date('Y'); }}
                                        @for($year = 2023; $year <= $now; $year++)
                                        <option value="{{ $year }}" {{ request('year_selected') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="date_range">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input type="date" id="date_start" name="date_start" class="form-control" value="{{ request('date_start') == null ? '' : request('date_start') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="date" id="date_end" name="date_end" class="form-control" value="{{ request('date_end') == null ? '' : request('date_end') }}">
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
                            <a class="btn btn-default" href="{{ route('report.selling') }}"><i class="fas fa-undo"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @if (!empty(request()->get('filter')))
    <div class="card">
        <div class="card-header">
            <span id="title-excel">Laporan Penjualan @if(request()->get('filter') != 'custom') {{ request()->get('filter') }} ({{ $date }}) @elseif (request()->get('filter') == 'custom') ({{ $date }}) @endif </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped" style="font-size: 10pt;">
                <thead>
                    <tr>
                        @can('isOwner')
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Cabang</th>
                        @endcan
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Tanggal</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Invoice</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Pelanggan</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Nominal</th>
                        <th colspan="2" class="text-center" style="vertical-align: middle;">Pembayaran</th>
                        <th colspan="2" class="text-center" style="vertical-align: middle;">Status</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;"><i class="fa fa-search"></i></th>
                    </tr>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">Cash</th>
                        <th class="text-center" style="vertical-align: middle;">Credit</th>
                        <th class="text-center" style="vertical-align: middle;">Piutang</th>
                        <th class="text-center" style="vertical-align: middle;">Lunas</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $total_nominal   = 0; 
                        $total_cash      = 0; 
                        $total_credit    = 0; 
                        $total_remaining = 0; 
                        $total_lunas     = 0; 
                    @endphp
                    @foreach($orders as $order)
                    <tr>
                        @can('isOwner')
                        <td>{{ $order->branch }}</td>
                        @endcan
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ $order->invoice }}</td>
                        <td>{{ $order->customer }}</td>
                        <td class="text-right">
                            {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}
                            @php $total_nominal += $order->grandtotal; @endphp
                        </td>
                        <td class="text-right">
                            @if($order->payment_method == 'cash')
                                {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}
                                @php $total_cash += $order->grandtotal;  @endphp
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">
                            @if($order->payment_method == 'credit')
                                {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}
                                @php $total_credit += $order->grandtotal; @endphp 
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">
                            @if($order->payment_method == 'credit' && $order->status == 'Belum Lunas')
                                {{ strrev(implode('.',str_split(strrev(strval( $order->remaining )),3))) }}
                                @php $total_remaining += $order->remaining; @endphp 
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">
                            @if($order->payment_method == 'credit' && $order->status == 'Lunas')
                                {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}
                                @php $total_lunas += $order->grandtotal; @endphp
                            @elseif($order->payment_method == 'cash')
                                {{ strrev(implode('.',str_split(strrev(strval( $order->grandtotal )),3))) }}
                                @php $total_lunas += $order->grandtotal; @endphp
                            @endif
                        </td>
                        <td><button class="btn btn-info btn-xs" onclick="detail('{{ $order->id }}')"><i class="fa fa-search"></i></button></td>
                    </tr>
                    @endforeach
                    <tr style="background-color: lightblue; font-weight:bold;">
                        @can('isOwner')
                        <td></td>
                        @endcan
                        <td colspan="3">Total</td>
                        <td class="text-right">{{ strrev(implode('.',str_split(strrev(strval( $total_nominal )),3))) }}</td>
                        <td class="text-right">{{ strrev(implode('.',str_split(strrev(strval( $total_cash )),3))) }}</td>
                        <td class="text-right">{{ strrev(implode('.',str_split(strrev(strval( $total_credit )),3))) }}</td>
                        <td class="text-right">{{ strrev(implode('.',str_split(strrev(strval( $total_remaining )),3))) }}</td>
                        <td class="text-right">{{ strrev(implode('.',str_split(strrev(strval( $total_lunas )),3))) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endif
</section>
<!-- /.content -->
<div class="modal fade" id="modalDetail" aria-hidden="true">
    <div id="imported-page"></div> 
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
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

    function detail(id) {
        $.get("{{ url('/transaction/history/detail') }}/" + id, {}, function(data, status) {
            $("#imported-page").html(data);
            $("#modalDetail").modal('show');
        });
    }
</script>
@endpush