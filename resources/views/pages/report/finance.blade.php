@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Keuangan</h1>
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
                            <a class="btn btn-default" href="{{ route('stock_in.list') }}"><i class="fas fa-undo"></i></a>
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
            <span id="title-excel">Laporan Keuangan @if(request()->get('filter') != 'custom') {{ request()->get('filter') }} ({{ $date }}) @elseif (request()->get('filter') == 'custom') ({{ $date }}) @endif </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered" id="example3">
                <thead>
                    <tr>
                        <th rowspan="2">Cabang</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Invoice</th>
                        <th rowspan="2">Pelanggan</th>
                        <th rowspan="2">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($orders))
                    @foreach ($orders as $a)
                    <tr>
                        <td>{{ $a->branch }}</td>
                        <td>{{ $a->invoice }}</td>
                        <td>Rp. {{ strrev(implode('.',str_split(strrev(strval( $a->grandtotal )),3))) }},-</td>
                        <td>-</td>
                    </tr>
                    @endforeach
                    @endif

                    @if(isset($stock_in))
                    @foreach ($stock_in as $b)
                    <tr>
                        <td>{{ $b->branch }}</td>
                        <td>{{ $b->invoice }}</td>
                        <td>-</td>
                        <td>
                            Rp. {{ strrev(implode('.',str_split(strrev(strval( $b->subtotal )),3))) }},-
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @if(isset($operationals))
                    @foreach ($operationals as $c)
                    <tr>
                        <td>{{ $c->branch }}</td>
                        <td>{{ $c->name }}</td>
                        <td>-</td>
                        <td>
                            Rp. {{ strrev(implode('.',str_split(strrev(strval( $c->nominal )),3))) }},-
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td></td>
                        <td class="text-right"><b>Total</b></td>
                        <td><b>Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_income )),3))) }},-</b></td>
                        <td><b>Rp. {{ strrev(implode('.',str_split(strrev(strval( $total_outcome )),3))) }},-</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"><b>Gross Profit</b></td>
                        <td><b>Rp. {{ strrev(implode('.',str_split(strrev(strval( $gross_profit )),3))) }},-</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"><b>Net Profit</b></td>
                        <td><b>Rp. {{ strrev(implode('.',str_split(strrev(strval( $net_profit )),3))) }},-</b></td>
                        <td></td>
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
</script>
@endpush